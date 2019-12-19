<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use nex\datepicker\DatePicker;
use \app\modules\admin\components\AdminTinyMce;

/* @var $this yii\web\View */
/* @var $model app\models\News */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date')->widget(
        DatePicker::className(), [
        'size' => 'sm',
        'clientOptions' => [
//            'defaultDate' => Yii::$app->formatter->asDatetime(time()),
            'format' => 'DD.MM.YYYY H:mm',
            'stepping' => 30,
        ],
    ]) ;?>

    <?= $form->field($model, 'announce')->widget(AdminTinyMce::className()) ?>

    <?= $form->field($model, 'text')->widget(AdminTinyMce::className()) ?>

    <?php if($model->image) {?>
        <img src="<?= Yii::getAlias('@web') . $model->image ?>">
        <br>
        <a href="<?= Url::to(['/admin/news/remove-image', 'id' => $model->id]) ?>" class="text-danger confirm-delete" title="Удалить">Удалить</a>
    <?php }?>
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
