<?php

use app\modules\admin\components\AdminTinyMce;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;

/**
 * @var $this yii\web\View
 * @var $model app\models\Content
 * @var $form yii\widgets\ActiveForm
 *
 */
?>

<div class="content-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php if (isset($live_edit)) {?>
        <?= $form->field($model, 'title')->hiddenInput()->label(false) ?>
        <?= $form->field($model, 'name')->hiddenInput()->label(false) ?>
        <h2><?= $model->name ?></h2>
    <?php }else{ ?>
        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?php } ?>
    <?= $form->field($model, 'text')->widget(AdminTinyMce::className()) ?>

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
