<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Invoice */

$this->title = 'Счет № ' . $model->id . ' к заказу № ' . $order->id;
$this->params['breadcrumbs'][] = ['label' => 'Счета', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoice-view">

    <h1>Счет к заказу # <?=$order->id?></h1>

    <p>
        <?= Html::a('К заказу', ['order/update', 'id' => $order->id], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Оплачен', ['pay', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Отклонить', ['close', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Отклонить счет?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'created',
            'expires',
            'sum',
            'statusText',
            'closed',
        ],
    ]) ?>

    <h2>Детализация</h2>
    <table class="table table-striped table-bordered detail-view">
        <thead>
            <tr>№<th></th><th>Наименование</th><th>Количество</th><th>Цена ед.</th><th>Цена ед. по скидке</th><th>Сумма</th></tr>
        </thead>
        <tbody>
            <?php $count = 1; ?>
            <?php foreach ($order->content as $item) { ?>
                <tr>
                    <td><?=($count++)?></td>
                    <td><?=$item->product->name;?></td>
                    <td><?=$item->count?></td>
                    <td><?=$item->product->price?></td>
                    <td><?=($item->price_discount ? $item->price_discount : '-')?></td>
                    <td><?=(($item->price_discount ? $item->price_discount : $item->product->price) * $item->count)?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</div>
