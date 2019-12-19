<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use nex\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\News */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="discount-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lifetime')->widget(
        DatePicker::className(), [
        'size' => 'sm',
        'language' => 'ru',
        'placeholder' => 'Годен до',
        'clientOptions' => [
//            'defaultDate' => Yii::$app->formatter->asDatetime(time()),
            'format' => 'DD.MM.YYYY',
            'stepping' => 30,
        ],
    ]) ?>

    <?= $form->field($model, 'cookie_expire')->textInput([
        'maxlength' => true,
        'placeholder' => ('По-умолчанию ' . \app\models\Discount::getDefaultCookieExpire(true) . ' дней')
    ]) ?>

    <?=$form->field($model, 'user_id')->dropDownList($users);?>

    <?php if(isset($values) && !empty($values)){?>
        <h3>Скидки</h3>
        <?php foreach($values as $obValue){ ?>
            <label><?=$obValue->product->name;?></label>
            <input class="form-control" name="discounts[<?=$obValue->product_id;?>]" value="<?=$obValue->percent;?>"><br>
        <?php } ?>

   <?php } ?>

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
