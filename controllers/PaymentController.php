<?php

namespace app\controllers;

use app\components\BaseController;
use app\components\Email;
use app\models\Invoice;
use app\models\Order;
use Yii;
use yii\web\NotFoundHttpException;

class PaymentController extends BaseController
{
    public function actionResult()
    {
        $InvId = Yii::$app->request->get('InvId');
        $OutSum = Yii::$app->request->get('OutSum');
        $SignatureValue = Yii::$app->request->get('SignatureValue');
        $shp = Yii::$app->request->get('Shp_item');

        $invoice = Invoice::findOne($InvId);

        if (empty($invoice)) {
            return 'FAIL invoice not found';
        }

        $order = Order::findOne(['invoice_id' => $InvId]);

        if (empty($order)) {
            return 'FAIL order deleted';
        }

        $merchant = new \app\components\Merchant(Yii::$app->params["robokassa"]);
        if (!$merchant->checkSignature($SignatureValue, $OutSum, $InvId,
            Yii::$app->params['robokassa']['sMerchantPass2'], $shp)) {
            return 'FAIL sign error';
        }

        if ($invoice->status != Invoice::STATUS_OPENED) {
            return 'FAIL incorrect invoice status';
        }

        if ($invoice->expires != 0 &&
            ((strtotime($invoice->created) - strtotime(date('Y-m-d H:i:s'))) > $invoice->expires)) {
            $invoice->status = Invoice::STATUS_EXPIRED;
            $invoice->closed = date('Y-m-d H:i:s');
            $invoice->save();
            return 'FAIL expire';
        }

        if ($OutSum < $invoice->sum) {
            return 'FAIL invalid sum';
        }

        $invoice->status = Invoice::STATUS_PAID;
        if (!$invoice->save()) {
            return 'FAIL internal error';
        }

        Email::notify('order/customer_after_pay', ['order' => $order]);
        Email::notify('order/manager', ['order' => $order]);

        return 'OK'.$invoice->id;
    }

    public function actionSuccess()
    {
        $InvId = Yii::$app->request->get('InvId');
        $OutSum = Yii::$app->request->get('OutSum');
        $SignatureValue = Yii::$app->request->get('SignatureValue');
        $shp = Yii::$app->request->get('Shp_item');

        $invoice = Invoice::findOne($InvId);

        if (empty($invoice) || $invoice->status != Invoice::STATUS_PAID) {
            throw new NotFoundHttpException();
        }

        $merchant = new \app\components\Merchant(Yii::$app->params["robokassa"]);
        if (!$merchant->checkSignature($SignatureValue, $OutSum, $InvId,
            Yii::$app->params['robokassa']['sMerchantPass1'], $shp)) {
            throw new NotFoundHttpException();
        }

        $order = Order::findOne(['invoice_id' => $invoice->id]);
        if (empty($order)) {
            throw new NotFoundHttpException();
        }

        return $this->render('/card/success', [
            'order' => $order
        ]);
    }

    public function actionFail()
    {
        $InvId = Yii::$app->request->get('InvId');
        // $OutSum = Yii::$app->request->get('OutSum');
        // $shp = Yii::$app->request->get('Shp_item');

        $invoice = Invoice::findOne($InvId);

        if (empty($invoice)) {
            throw new NotFoundHttpException();
        }

        switch ($invoice->status) {
            case Invoice::STATUS_PAID:
                $message = 'Счет уже был оплачен.';
                break;
            case Invoice::STATUS_EXPIRED:
                $message = 'Истек срок платежа. Пожалуйста, оформите новый заказ.';
                break;
            case Invoice::STATUS_OPENED:
                $message = 'Вы отказались от оплаты. Вы можете вернуться на страницу оплаты нажав <Назад> в браузере.';
                break;
            default:
                $message = 'Не удалось провести платеж.';
        }

        return $this->render('fail', [
            'message' => $message
        ]);
    }
}