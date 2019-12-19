<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = 'Обновить товар: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Продукция', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="product-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
