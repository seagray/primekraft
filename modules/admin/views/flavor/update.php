<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Flavor */

$this->title = 'Обновить вкус: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Вкусы', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="flavor-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
