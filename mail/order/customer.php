<?php
/**
 * @var \app\models\Order $order
 */
use yii\helpers\Html;
?>

<div class="wrapper">
    <article class="content">
        <h1>Заказ успешно сформирован!</h1>
        <p class="num_order">Ваш заказ <b>№<span><?=$order->id?></span></b></p>
        <table>
            <thead>
            <tr>
                <th>Название</th>
                <th>Цена</th>
                <th>Количество</th>
                <th>Сумма (с учетом скидки)</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($order->content as $item) {?>
                <tr>
                    <td><?=Html::encode($item->product->displayName)?></td>
                    <td><?=Html::encode($item->product->price)?></td>
                    <td><?=Html::encode($item->count)?></td>
                    <td><?=Html::encode($item->price_discount)?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <div>Стоимость доставки: <b><span><?=Html::encode($order->delivery_cost)?></span>р.</b></div>
        <div class="total_order">Итого (включая доставку): <b><span><?=Html::encode($order->sum + $order->delivery_cost)?></span>р.</b></div>

        <div>Оформлен на имя: <?=Html::encode($order->fio)?></div>
        <div>Телефон для связи: <?=Html::encode($order->phone)?></div>
        <div>Адрес доставки: <?=Html::encode($order->address)?></div>
        <div>Пожелания: <?=Html::encode($order->comment)?></div>

        <?php if (!$order->payment_on_delivery) { ?>
            <div>Вы можете оплатить заказ по <a href="<?php
                $merchant = new \app\components\Merchant(\Yii::$app->params["robokassa"]);
                echo $merchant->getUrl($order->sum + $order->delivery_cost, $order->invoice_id, "Оплата заказа №" . $order->id . " на сайте primekraft.ru", null, $order->email);
            ?>" title="Оплатить">этой ссылке</a></div>
        <?php } ?>
    </article>
</div>