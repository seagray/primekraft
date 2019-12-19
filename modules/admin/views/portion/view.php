<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Portion */

$this->title = "$model->productName со вкусом $model->flavorName";
$this->params['breadcrumbs'][] = ['label' => 'Порции', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="portion-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'product_id' => $model->product_id, 'flavor_id' => $model->flavor_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'product_id' => $model->product_id, 'flavor_id' => $model->flavor_id], [
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
            'product_id',
            'flavor_id',
            'portion_weight',
            'description:ntext',
            'energy',
            'protein',
            'fat',
            'carbs',
            'energy_per_100',
            'protein_per_100',
            'fat_per_100',
            'carbs_per_100',
        ],
    ]) ?>

</div>
