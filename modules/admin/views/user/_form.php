<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?php //= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'nickname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

<!--    --><?php //= $form->field($model, 'password_hash')->textInput(['maxlength' => true]) ?>

<!--    --><?php //= $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?>
<!---->
<!--    --><?php //= $form->field($model, 'confirmed_at')->textInput() ?>
<!---->
<!--    --><?php //= $form->field($model, 'unconfirmed_email')->textInput(['maxlength' => true]) ?>
<!---->
<!--    --><?php //= $form->field($model, 'blocked_at')->textInput() ?>
<!---->
<!--    --><?php //= $form->field($model, 'registration_ip')->textInput(['maxlength' => true]) ?>

<!--    --><?php //= $form->field($model, 'created_at')->textInput() ?>
<!---->
<!--    --><?php //= $form->field($model, 'updated_at')->textInput() ?>

<!--    --><?php //= $form->field($model, 'flags')->textInput() ?>
<!---->
    <?= $form->field($model, 'role')->dropDownList(\app\models\User::roleList()) ?>
    <?= $form->field($model, 'referrer_id')->dropDownList($users) ?>

<!---->
<!--    --><?php //= $form->field($model, 'hold')->textInput(['maxlength' => true]) ?>
<!---->
<!--    --><?php //= $form->field($model, 'pay')->textInput(['maxlength' => true]) ?>
<!---->
<!--    --><?php //= $form->field($model, 'payout')->textInput(['maxlength' => true]) ?>
<!---->
<!--    --><?php //= $form->field($model, 'is_code')->textInput() ?>

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
