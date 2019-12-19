<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PortionProperties */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="portion-properties-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'value_per_100')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ord')->textInput() ?>

    <?= $form->field($model, 'public')->checkbox() ?>

    <?= $form->field($model, 'portion_id')->dropDownList(\app\models\Portion::getList()) ?>

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
