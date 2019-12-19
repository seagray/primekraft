<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Flavor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="flavor-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_small')->textInput(['maxlength' => true]) ?>

    <?php if($model->image) {?>
        <img src="<?= Yii::getAlias('@web') . $model->image ?>">
        <br>
        <a href="<?= Url::to(['/admin/flavor/remove-image', 'id' => $model->id]) ?>" class="text-danger confirm-delete" title="Удалить">Удалить</a>
    <?php }?>
    <?= $form->field($model, 'image')->fileInput() ?>

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
