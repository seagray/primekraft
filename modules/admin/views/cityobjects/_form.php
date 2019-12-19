<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\helpers\Form;

/* @var $this yii\web\View */
/* @var $model app\models\CityObjects */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="city-objects-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'latitude')->textInput() ?>
    <?= $form->field($model, 'longitude')->textInput() ?>
    <?=Form::MapCoord('#cityobjects-name', '#cityobjects-latitude', '#cityobjects-longitude')?>

    <?= $form->field($model, 'city_id')->dropDownList(\app\models\City::getAllPublicList()) ?>

    <?= $form->field($model, 'type')->dropDownList(\app\models\CityObjects::$typeList) ?>

    <?= $form->field($model, 'public')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить и выйти' : 'Сохранить и выйти', [
            'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
            'name' => '__redirect_to', 'value' => 'list'
        ]) ?>
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', [
            'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
            'name' => '__redirect_to', 'value' => 'view'
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
