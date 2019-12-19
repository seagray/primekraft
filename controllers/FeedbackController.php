<?php

namespace app\controllers;

use app\components\BaseController;
use app\components\Email;
use app\forms\DistributionForm;
use app\models\Discount;
use app\models\DistributionRequest;
use app\models\Feedback;
use app\models\LoginForm;
use app\models\User;
use app\models\Vacancy;
use yii;
use yii\helpers\Url;

/**
 * Class FeedbackController
 * @package app\controllers
 */
class FeedbackController extends BaseController
{
    public function actionIndex()
    {
        if (Yii::$app->user->getIdentity()->role == 'agent') {
            return $this->redirect(['personal/index']);
        }
        Yii::$app->params['current_page'] = 'couch';
        $model = new LoginForm();

        return $this->render('index', [
            'model' => $model,
            'promoCode' => Discount::getPromo()
        ]);
    }

    /**
     * Отправка резюме
     * @return bool
     */
    public function actionRegistration()
    {
        $model = new Vacancy();
        $model->dt = date('Y-m-d H:i:s');
        $file = yii\web\UploadedFile::getInstanceByName('file');

        $isPost = $model->load(Yii::$app->request->post(), '');
        $model->file = $file; // for validate()
        if ($isPost && $model->validate()) {
            $promoCode = \Yii::$app->request->post('promoCode');

            $isUserPromoCode = true;
            if (empty($promoCode)) {
                $promoCode = \Yii::$app->params['user']['defaultRegisterPromocode'];
                $isUserPromoCode = false;
            }

            $discount = Discount::findOne(['code' => mb_strtoupper($promoCode)]);
            if (empty($discount)) {
                if ($isUserPromoCode) {
                    return json_encode(['success' => false, 'errors' => ['promoCode' => ['Неверный промо-код']]]);
                }
            } else {
                $referrer = User::findOne($discount->user_id);
                if (!empty($referrer)) {
                    $model->referrer_id = $referrer->id;
                }
            }

            if (empty($model->referrer_id)) {
                \Yii::warning('User ' . $model->email . ' register without referrer. Check default promocode.');
            }

            if ($file) {
                $model->file = 'uploads/vacancy/' . uniqid() . '.' . $file->extension;
            }
            if ($model->save()) {

                if ($file) {
                    $file->saveAs(Yii::getAlias('@webroot/') . $model->file);
                }
                $this->refresh();

                $user = new User;
                $user->email = $model->email;
                $user->username = $model->email;
                $user->nickname = $model->name;
                $user->newPassword = Yii::$app->request->post('password');
                $user->role = 'agent';
                $user->referrer_id = $model->referrer_id;
                if (!$user->save()) {
                    echo json_encode(['success' => false, 'errors' => $user->getErrors()]);
                    exit();
                }
                $user->createDiscount(\Yii::$app->params['discounts']);

                Email::notify('partner/register', ['model' => $model]);

                // автоматическая авторизация нового пользователя
                if (!\Yii::$app->user->isGuest) {
                    Yii::$app->user->logout();
                }
                Yii::$app->user->login($user, 3600 * 24 * 30);

                echo json_encode(['success' => true, 'errors' => [], 'redirect' => Url::to('/personal/index')]);
                exit();
            }
            echo json_encode(['success' => false, 'errors' => $model->getErrors()]);
            exit();
        } else {
            echo json_encode(['success' => false, 'errors' => $model->getErrors()]);
            exit();
        }
    }

    public function actionSend()
    {
        $model = new Feedback();
        if ($model->load(Yii::$app->request->post(), '') && $model->save()) {
            Email::notify('feedback/common', ['form' => $model]);
            $response = ['success'=> true, 'errors' => []];
        } else {
            $response = ['success'=> false, 'errors' => $model->errors];
        }
        echo json_encode($response);
    }

    public function actionDistribution()
    {
        $model = new DistributionRequest();
        if ($model->load(Yii::$app->request->post(), '') && $model->save()) {
            Email::notify('feedback/distribution', ['form' => $model]);
            echo json_encode(['success'=> true, 'errors' => []]);
        } else {
            echo json_encode(['success'=> false, 'errors' => $model->errors]);
        }
    }
}
