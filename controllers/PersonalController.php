<?php

namespace app\controllers;

use app\components\BaseController;
use app\components\Card;
use app\components\Email;
use app\models\Discount;
use app\models\Order;
use app\models\OrderStatus;
use app\models\Payout;
use app\models\search\OrderSearch;
use app\models\search\PayoutSearch;
use app\models\search\TransactionSearch;
use app\models\Transaction;
use app\models\User;
use yii;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;


class PersonalController extends BaseController
{
    public function beforeAction($action)
    {
        \Yii::$app->params['personal-activePage'] = $action->id;
        if (!\Yii::$app->user->can('view_agent')) {
            throw new yii\web\ForbiddenHttpException('Access denied');
        }

        return true;
    }

    public function actionIndex()
    {
        $nSum = 0;
        /**
         * @var User $obUser
         */
        $obUser = Yii::$app->user->identity;
        $obDiscount = Discount::find()->where(['user_id' => $obUser->id])->one();

        if ($obUser->hold >= \Yii::$app->params['discountMinPayout']) {
            $nSum = $obUser->hold;
        }

        if (Yii::$app->request->isPost) {

            $arPost = Yii::$app->request->post();

            if (isset($arPost['code_change']) && !empty($arPost['code'])) {
                $obDiscount->code = mb_strtoupper($arPost['code']);
                $obDiscount->save();
            }

            if (isset($arPost['payout']) && $obUser->hold >= \Yii::$app->params['discountMinPayout']) {
                $obPayout = new Payout();
                $obPayout->user_id = $obUser->id;
                $obPayout->status = 0;
                $obPayout->sum = $nSum;

                if ($obPayout->save()) {
                    Email::notify('partner/payout-manager', ['model' => $obPayout]);
                    $obUser->hold = 0;
                    $obUser->save();
                    return $this->redirect(['personal/payouts']);
                }
            }
        }

        $params = ['user_id' => $obUser->id];
        $obSearch = OrderSearch::search($params);
        $orders = $obSearch->getModels();
        $newOrdersSum = 0;
        foreach ($orders as $order) {
            if ($order->status->code != OrderStatus::STATUS_CODE_REJECT
                && $order->status->code != OrderStatus::STATUS_CODE_COMPLETE) {
                $newOrdersSum = Card::getPercent($order->sum + $order->discount, \Yii::$app->params['partnerChargePercent_lvl1']);
            }
        }

        $referrals = User::findAll(['referrer_id' => $obUser->id]);
        $referralsSum = 0;
        foreach ($referrals as $referral) {
            if (!empty($referral->discount)) {
                $orders = Order::findAll(['discount_id' => $referral->discount->id]);
                $order_ids = [];
                array_walk($orders, function(Order $order) use(&$order_ids) { $order_ids[] = $order->id; });

                $referralsSum += Transaction::find()->andWhere(['user_id' => $obUser->id])
                    ->andWhere(['in', 'order_id', $order_ids])->sum('sum');
            }
        }

        return $this->render('index', [
            'user' => $obUser,
            'discount' => $obDiscount,
            'sum' => $nSum,
            'newOrdersSum' => $newOrdersSum,
            'referralsSum' => $referralsSum
        ]);
    }

    public function actionOrders()
    {
        /* @var User $obUser */
        $obUser = Yii::$app->user->identity;

        $params = $this->getPeriod();
        $params['user_id'] = $obUser->id;

        $obSearch = OrderSearch::search($params);

        $arModels = $obSearch->getModels();
        $pagination = $obSearch->getPagination();

        $transactions = Transaction::find()->where(['user_id' => $obUser->id])->all();
        $transactions = ArrayHelper::map($transactions, 'order_id', 'sum');

        foreach ($arModels as $order) {
            switch($order->status->code ) {
                case OrderStatus::STATUS_CODE_REJECT:
                    $transactions[$order->id] = 0;
                    break;
                case OrderStatus::STATUS_CODE_NEW:
                case OrderStatus::STATUS_CODE_WORK:
                case OrderStatus::STATUS_CODE_TRACK:
                    $transactions[$order->id] = Card::getPercent($order->sum + $order->discount,
                        \Yii::$app->params['partnerChargePercent_lvl1']);
                    break;
                case OrderStatus::STATUS_CODE_COMPLETE:
                    if (!isset($transactions[$order->id])) {
                        $transactions[$order->id] = Card::getPercent($order->sum + $order->discount,
                            \Yii::$app->params['partnerChargePercent_lvl1']);
                    }
            }
        }

        return $this->render('orders', [
            'arItems' => $arModels,
            'pagination' => $pagination,
            'params' => $params,
            'transactions' => $transactions,
            'isFiltered' => !empty(\Yii::$app->request->get())
        ]);
    }

    public function actionTransactions()
    {
        /* @var User $obUser */
        $obUser = Yii::$app->user->identity;

        $params = $this->getPeriod();
        $params['user_id'] = $obUser->id;
        $obSearch = TransactionSearch::search($params);

        $arModels = $obSearch->getModels();
        $pagination = $obSearch->getPagination();

        return $this->render('transactions', [
            'arItems' => $arModels,
            'pagination' => $pagination,
            'user' => $obUser,
            'params' => $params,
            'isFiltered' => !empty(\Yii::$app->request->get())
        ]);
    }

    private function getPeriod()
    {
        $request = Yii::$app->request;

        $from = $request->get('from');
        $to = $request->get('to');

        $params = [];
        if ($from && $from = new \DateTime($from)) {
            $params['date_from'] = $from->format('Y-m-d');
        }

        if ($to && $to = new \DateTime($to)) {
            $params['date_to'] = $to->format('Y-m-d');
        }

        return $params;
    }

    public function actionPayouts()
    {
        /* @var User $obUser */
        $obUser = Yii::$app->user->identity;

        $params = $this->getPeriod();
        $params['user_id'] = $obUser->id;
        $obSearch = PayoutSearch::search($params);

        $arModels = $obSearch->getModels();
        $pagination = $obSearch->getPagination();

        return $this->render('payouts', [
            'arItems' => $arModels,
            'pagination' => $pagination,
            'user' => $obUser,
            'params' => $params,
            'isFiltered' => !empty(\Yii::$app->request->get())
        ]);
    }

    public function actionReferrals()
    {
        /* @var User $user */
        $user = Yii::$app->user->identity;

        $referralsQuery = User::find()->where(['referrer_id' => $user->id]);
        $referralsCount = clone $referralsQuery;
        $pagination = new Pagination(['totalCount' => $referralsCount->count()]);
        $pagination->setPageSize(8);
        $referrals = $referralsQuery->offset($pagination->offset)
                                    ->limit($pagination->limit)->all();

        $referrals = array_map(function(User $referral) use ($user) {
            if (!empty($referral->discount)) {
                $orders = Order::findAll(['discount_id' => $referral->discount->id]);
                $order_ids = [];
                array_walk($orders, function(Order $order) use(&$order_ids) { $order_ids[] = $order->id; });

                $sum = Transaction::find()->andWhere(['user_id' => $user->id])
                                          ->andWhere(['in', 'order_id', $order_ids])->sum('sum');
            } else {
                $sum = 0;
            }

            return ['user' => $referral, 'sum' => $sum];
        }, $referrals);

        return $this->render('referrals', [
            'referrals' => $referrals,
            'pagination' => $pagination
        ]);
    }
}