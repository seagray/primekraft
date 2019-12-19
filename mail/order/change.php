<?php
/**
 * @var \app\models\Order $order
 */
use yii\helpers\Html;
?>

<div class="wrapper">
    <article class="content">
        <h1>Заказ №<?=$order->id?> изменен</h1>
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
        <div class="total_order">Итого (с учетом доставки): <b><span><?=Html::encode($order->sum + $order->delivery_cost)?></span>р.</b></div>
    </article>
</div>