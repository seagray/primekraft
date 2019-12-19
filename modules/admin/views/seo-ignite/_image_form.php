<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SeoIgniteStorage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="seo-ignite-storage-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype'=>'multipart/form-data']
    ]); ?>

    <?= $form->field($model, 'src')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alt')->textarea(['maxlength' => true]) ?>
    <?= $form->field($model, 'title')->textarea(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', [
            'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
