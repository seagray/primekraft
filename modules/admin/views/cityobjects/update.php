<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CityObjects */

$this->title = 'Изменить объект: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Городские объекты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="city-objects-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
