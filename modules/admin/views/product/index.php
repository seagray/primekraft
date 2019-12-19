<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Продукция';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Проверить ссылки на магазины', ['check-links'], ['class' => 'btn btn-success']) ?>
    </p>
    <p>
        <?= Html::a('Добавить товар', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            [
                'attribute' => 'category.name',
                'format' => 'text',
                'label' => 'Категория'
            ],
            'price',
            'portions_count',
            'weight',
            [
                'attribute' => 'available',
                'content' => function($model) {
                    return $model->available ? "Да" : "Нет";
                }
            ],
            // 'description:ntext',
            // 'image',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
