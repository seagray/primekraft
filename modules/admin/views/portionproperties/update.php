<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PortionProperties */

$this->title = 'Изменить свойство порции: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Свойства порций', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменение';
?>
<div class="portion-properties-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
