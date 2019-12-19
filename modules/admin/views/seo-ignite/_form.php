<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="seo-ignite-storage-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype'=>'multipart/form-data']
    ]); ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>
    <?= $form->field($model, 'keywords')->textarea(['maxlength' => true]) ?>
    <?= $form->field($model, 'h1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'og_url')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'og_type')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'og_site_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'og_title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'og_description')->textarea(['maxlength' => true]) ?>
    <?= $form->field($model, 'og_image')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить и выйти' : 'Сохранить и выйти', [
            'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
            'name' => '__redirect_to', 'value' => 'list'
        ]) ?>
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', [
            'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
            'name' => '__redirect_to', 'value' => 'self'
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
