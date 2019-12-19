<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Team */

$this->title = 'Обновить спортсмена: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Команда', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="team-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
