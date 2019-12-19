<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Portion */

$this->title = 'Добавить порцию';
$this->params['breadcrumbs'][] = ['label' => 'Порции', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="portion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'products' => $products,
        'flavors' => $flavors,
    ]) ?>

</div>
