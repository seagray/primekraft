<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Изменить данные изображения';
$this->params['breadcrumbs'][] = ['label' => 'SEO изображений', 'url' => ['images']];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="seo-ignite-storage-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_image_form', [
        'model' => $model,
    ]) ?>

</div>
