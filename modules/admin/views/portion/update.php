<?php

use yii\helpers\Html;

/**
 * @var $products array
 * @var $this yii\web\View
 * @var $model app\models\Portion
 */

$this->title = "Редактирование продукта $model->productName со вкусом $model->flavorName";
$this->params['breadcrumbs'][] = ['label' => 'Порции', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => "{$model->productName} со вкусом {$model->flavorName}", 'url' => ['view', 'product_id' => $model->product_id, 'flavor_id' => $model->flavor_id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="portion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'products' => $products,
        'flavors' => $flavors,
    ]) ?>

</div>
