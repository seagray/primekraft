<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use nex\datepicker\DatePicker;
use app\modules\admin\components\AdminTinyMce;

/**
 * @var $this yii\web\View
 * @var $model app\models\Article
 * @var $form yii\widgets\ActiveForm
 */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date')->widget(DatePicker::className(), [
        'size' => 'sm',
        'language' => 'ru',
        'placeholder' => 'Дата опубликования',
        'clientOptions' => [
            'format' => 'DD.MM.YYYY',
            'stepping' => 30,
        ],
    ]) ;?>

    <?= $form->field($model, 'announce')->widget(AdminTinyMce::className()) ?>

    <?= $form->field($model, 'text')->widget(AdminTinyMce::className()) ?>

    <?= $form->field($model, 'image')->fileInput() ?>

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
