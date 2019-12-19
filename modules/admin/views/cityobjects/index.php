<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \app\models\CityObjects;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Городские объекты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="city-objects-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить объект', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'latitude',
            'longitude',
            [
                'label' => 'Город',
                'value' => 'city.name',
                'format' => 'raw'
            ],
            [
                'label' => 'Тип',
                'value' => function(CityObjects $item){
                    return $item->getTypeLabel();
                },
                'format' => 'raw'
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
