<?php

namespace app\modules\admin\controllers;

use app\components\Card;
use app\components\Email;
use app\models\Discount;
use app\models\DiscountValue;
use app\models\Order;
use app\models\OrderContent;
use app\models\OrderStatus;
use app\models\Transaction;
use app\models\User;
use Yii;
use app\models\News;
use yii\base\ErrorException;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\helpers\Image;
use app\modules\admin\components\BaseController;


class OrderController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        \Yii::$app->params['activePage'] = 'shop';
        return array_merge(parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ]);
    }

    /**
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {

        $arGet = Yii::$app->request->get();
        $obStatuses = OrderStatus::find()->orderBy(['sort' => SORT_ASC])->all();

        $obQuery = Order::find()->joinWith(['status'])->orderBy(['sort' => SORT_ASC, 'date' => SORT_DESC]);

        if (!empty($arGet['sort'])) {
            $sort = $arGet['sort'];
            if ($sort[0] == '-') {
                $sort = mb_substr($sort, 1);
                $type = SORT_DESC;
            } else {
                $type = SORT_ASC;
            }
            $obQuery->orderBy([$sort => $type]);
        } else {
            $obQuery->orderBy(['sort' => SORT_ASC, 'date' => SORT_DESC]);
        }

        if (!empty($arGet['status_id'])) {
            $obQuery = $obQuery->where(['status_id' => $arGet['status_id']]);
        }

        if (!empty($arGet['date'])) {
            $obQuery = $obQuery->andWhere('date > :date_from',
                array(':date_from' => date('Y-m-d', strtotime($arGet['date']))));
            $obQuery = $obQuery->andWhere('date < :date_to',
                array(':date_to' => date('Y-m-d', strtotime("+1 day " . $arGet['date']))));
        }

        // Ограничение для партнера-менеджера
        if (!\Yii::$app->user->can('admin')) {
            $obQuery->where(['<>', 'discount_id', '0']);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $obQuery,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'arStatuses' => $obStatuses,
            'viewOnly' => !\Yii::$app->user->can('admin')
        ]);
    }

    /**
     * Displays a single Order model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'update' page.
     * @param integer $id
     * @throws \yii\base\ErrorException
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $arStatuses = [];
        $model = $this->findModel($id);
        $statuses = OrderStatus::find()->all();

        foreach ($statuses as $obStatus) {
            $arStatuses[$obStatus->id] = $obStatus->name;
        }

        $arValues = [];

        if (isset($model->content) && !empty($model->content)) {
            $arValues = $model->content;
        }

        if (Yii::$app->request->isPost) {

            $arPost = Yii::$app->request->post();

            if (in_array($model->status->code, [
                OrderStatus::STATUS_CODE_COMPLETE,
                OrderStatus::STATUS_CODE_REJECT
            ])) {
                throw new ErrorException('Отработанный заказ менять нельзя');
            }

            $nDiscount = $model->sum;
            $nSum = $model->discount;

            $model->fio = $arPost['Order']['fio'];
            $model->phone = $arPost['Order']['phone'];
            $model->email = $arPost['Order']['email'];
            $model->address = $arPost['Order']['address'];

            $arProductsDiscount = [];

            if (!empty($model->discount_id)) {
                $obDiscounts = DiscountValue::find()->where(['discount_id' => $model->discount_id])->all();

                foreach ($obDiscounts as $obDiscount) {
                    $arProductsDiscount[$obDiscount->product_id] = $obDiscount->percent;
                }
            }

            if (!empty($arPost['products'])) {
                $arProducts = OrderContent::find()->where(['order_id' => $model->id])->all();

                $nDiscount = 0;
                $nSum = 0;

                foreach ($arProducts as $obProduct) {

                    $nCount = intval($arPost['products'][$obProduct->product_id]['count']);

                    if ($nCount <= 0) {
                        $obProduct->delete();
                        continue;
                    }

                    $nPrice = $obProduct->product->price * intval($arPost['products'][$obProduct->product_id]['count']);

                    if ($obProduct->price != $arPost['products'][$obProduct->product_id]['price']) {
                        $nPrice = $arPost['products'][$obProduct->product_id]['price'];
                    }

                    $nPriceDiscount = 0;

                    if (!empty($arProductsDiscount[$obProduct->product_id])) {
                        $nPriceDiscount = Card::getPercent($nPrice, 100 - $arProductsDiscount[$obProduct->product_id]);
                    }

                    if ($obProduct->price_discount != $arPost['products'][$obProduct->product_id]['price_discount']) {
                        $nPriceDiscount = $arPost['products'][$obProduct->product_id]['price_discount'];
                    }

                    $obProduct->count = $nCount;
                    $obProduct->order_id = $model->id;
                    $obProduct->price = $nPrice;
                    $obProduct->price_discount = ceil($nPriceDiscount);

                    $nSum = $nSum + $nPriceDiscount;
                    $nDiscount = $nDiscount + intval($nPrice - $nPriceDiscount);

                    $obProduct->save();
                }

            }

            $model->sum = ceil($nSum);
            $model->discount = intval($nDiscount);


            Email::notify('order/change', ['order' => $model]);

            $model->status_id = $arPost['Order']['status_id'];

            $newStatus = OrderStatus::findOne(['id' => $model->status_id]);

            if ($newStatus->code == OrderStatus::STATUS_CODE_COMPLETE && !empty($model->discount_id)) {

                $totalSum = $model->sum + $model->discount;

                $obDiscount = Discount::find()->where(['id' => $model->discount_id])->one();

                if (!empty($obDiscount) && !empty($obDiscount->user_id)) {

                    $obDiscount->is_order = 1;
                    $obDiscount->save();

                    $obAgent = User::find()->where(['id' => $obDiscount->user_id])->one();

                    $receivers = [
                        [
                            'user' => $obAgent,
                            'amount' => Card::getPercent($totalSum, \Yii::$app->params['partnerChargePercent_lvl1'])
                        ],
                        [
                            'user' => $obAgent ? $obAgent->referrer : null,
                            'amount' => Card::getPercent($totalSum, \Yii::$app->params['partnerChargePercent_lvl2'])
                        ]
                    ];
                    foreach ($receivers as $receiver) {
                        if ($receiver['user']) {
                            /* @var User $agent */
                            $agent = $receiver['user'];

                            $total = $agent->hold  + $receiver['amount'];

                            $agent->hold  = $total;

                            $obTransaction = new Transaction();

                            $arLog = [];

                            $obTransaction->user_id = $arLog['user_id'] = $agent->id;
                            $obTransaction->direction = $arLog['direction'] = 1;
                            $obTransaction->sum = $arLog['sum'] = $receiver['amount'];
                            $obTransaction->order_id = $arLog['order_id'] = $model->id;
                            $obTransaction->comment = $arLog['comment'] = 'Оплачен заказ от ' . $model->date;
                            $obTransaction->save();
                            \Yii::info($arLog, 't');

                            $agent->pay = $agent->pay + $receiver['amount'];
                            $agent->save();

                            Email::notify('partner/transaction', ['model' => $obTransaction]);
                        }
                    }
                }
            }

            $model->save();
            
            return $this->redirectAfterSave($model->id);
        } else {
            return $this->render('update', [
                'model' => $model,
                'statuses' => $arStatuses,
                'values' => $arValues
            ]);
        }
    }

    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return \app\models\Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::find()->joinWith([
                'status',
                'content.product'
            ])->where(['orders.id' => $id])->one()) !== null
        ) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
