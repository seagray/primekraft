<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Дополнительные свойства порций';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="portion-properties-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>Выводятся в таблице калорийности продукта</p>
    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'value',
            'value_per_100',
            'ord',
             'public',
            [
                'attribute' => 'portion.product.name',
                'format' => 'text',
                'label' => 'Продукт'
            ],
            [
                'attribute' => 'portion.flavor.name',
                'format' => 'text',
                'label' => 'Вкус'
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
