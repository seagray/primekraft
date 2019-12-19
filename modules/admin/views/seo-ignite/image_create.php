<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Добавить данные изображения';
$this->params['breadcrumbs'][] = ['label' => 'SEO - изображений', 'url' => ['images']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seo-ignite-storage-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_image_form', [
        'model' => $model,
    ]) ?>

</div>
