<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\News */

$this->title = 'Обновить заказ: ' . $model->fio;
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="news-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if ($model->invoice_id) { ?>
        <p>
            <?= Html::a('К счету', ['invoice/view', 'id' => $model->invoice_id], ['class' => 'btn btn-info', 'target' => '_blank']) ?>
        </p>
    <?php } ?>

    <?= $this->render('_form', [
        'model' => $model,
        'statuses'=>$statuses,
        'values'=>$values
    ]) ?>

</div>
