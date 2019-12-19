<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Добавить SEO - параметр';
$this->params['breadcrumbs'][] = ['label' => 'SEO - параметры', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seo-ignite-storage-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
