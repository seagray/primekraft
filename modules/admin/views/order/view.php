<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\News */

$this->title = $model->fio;
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'createDate',
            'fio',
            'email',
            'phone',
            'address',
            'comment',
            'sum',
            'status.name',
        ],
    ]) ?>

    <h1>Состав заказа</h1>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Название</th>
            <th>Цена</th>
            <th>Количество</th>
            <th>Сумма (с учетом скидки)</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($model->content as $item) {?>
            <tr>
                <td><?=Html::encode($item->product->displayName)?></td>
                <td><?=Html::encode($item->product->price)?></td>
                <td><?=Html::encode($item->count)?></td>
                <td><?=Html::encode($item->price_discount)?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
