<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CatalogueTags */

$this->title = 'Добавить группу товаров';
$this->params['breadcrumbs'][] = ['label' => 'Группы товаров', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalogue-tags-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
