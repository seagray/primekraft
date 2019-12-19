<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PortionProperties */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Свойства порций', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="portion-properties-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить этот элемент?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'value',
            'value_per_100',
            'ord',
            'public',
            'portion_id',
        ],
    ]) ?>

</div>
