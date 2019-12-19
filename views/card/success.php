<?php
/**
 * @var \app\models\Order $order
 */
use yii\helpers\Html;

?>
<div class="wrapper">
    <article class="content">
        <div class="success-cart">
            <?php if (isset($this->context->h1) && !empty($this->context->h1)) { ?>
                <h1><?=Html::encode($this->context->h1)?></h1>
            <?php } else { ?>
                <h1>Заказ успешно сформирован!</h1>
            <?php } ?>
            <p>Наш менеджер скоро с вами свяжется.</p>
            <p class="num_order">Ваш заказ <b>№<span><?=$order->id?></span></b></p>
            <table>
                <thead>
                <tr>
                    <th>Название</th>
                    <th>Цена</th>
                    <th>Количество</th>
                    <th>Сумма</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($order->content as $item) { ?>
                    <tr>
                        <td><?=$item->product->displayName?></td>
                        <td><?=$item->product->price?></td>
                        <td><?=$item->count?></td>
                        <td><?=$item->price?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            <div class="total_order">Итого (c учетом доставки): <b><span><?=$order->sum + $order->delivery_cost?></span>р.</b></div>
        </div>
    </article>
</div>