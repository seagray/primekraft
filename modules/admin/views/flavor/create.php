<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Flavor */

$this->title = 'Добавить вкус';
$this->params['breadcrumbs'][] = ['label' => 'Вкусы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="flavor-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
