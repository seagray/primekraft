<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Статьи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить статью', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
        //    ['class' => 'yii\grid\SerialColumn'],

            'id',
            'url',
            'title',
            'date',
            [
                'attribute' => 'announce',
                'format' => 'html'
            ],
            [
                'attribute' => 'public',
                'content' => function($data) {
                    return $data->public ? 'Да' : 'Нет';
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
