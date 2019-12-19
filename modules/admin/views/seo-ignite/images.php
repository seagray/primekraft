<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'SEO - параметры изображений';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="seo-ignite-image-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить', ['image-create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div>
        <form action="<?=\yii\helpers\Url::to('/admin/seo-ignite/images')?>" method="get">
            <label>
                <span>Поиск по URL изображения</span>
                <input type="text" name="src" value="<?=$src?>"/>
            </label>
            <input type="submit" value="Найти"/>
        </form>
    </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            'src',
            'alt',
            'title',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}{delete}',
                'urlCreator' => function ($action, $model, $id, $index) {
                    return \yii\helpers\Url::to(['/admin/seo-ignite/image-' . $action, 'id' => $id]);
                }
            ],
        ],
    ]); ?>
</div>
