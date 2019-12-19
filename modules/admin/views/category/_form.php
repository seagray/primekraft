<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Category */
/* @var $form yii\widgets\ActiveForm */



?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList(\app\models\Category::getTypeList()) ?>

    <?php if($model->image) {?>
        <img src="<?= Yii::getAlias('@web') . $model->image ?>">
        <br>
        <a href="<?= \yii\helpers\Url::to(['/admin/category/remove-image', 'id' => $model->id]) ?>" class="text-danger confirm-delete" title="Удалить">Удалить</a>
    <?php }?>
    <?= $form->field($model, 'image')->fileInput() ?>

    <?= $form->field($model, 'ord')->textInput() ?>

    <?= $form->field($model, 'lineNumberOnMainPage')->textInput() ?>

    <?= $form->field($model, 'public')->checkbox() ?>

    <?= $form->field($model, 'groups')->widget(
        \kartik\select2\Select2::className(), [
        'data' => \app\models\CatalogueTags::getList(),
        'options' => ['multiple' => true]
    ])->label("Группы");  ?>

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
