<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\News */

$this->title = 'Обновить промокод: ' . $model->code;
$this->params['breadcrumbs'][] = ['label' => 'Промокоды', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="news-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'users' =>$users,
        'values'=>$values
    ]) ?>

</div>
