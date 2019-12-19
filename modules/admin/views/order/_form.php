<?php

use app\models\OrderStatus;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use nex\datepicker\DatePicker;

/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'createDate')->textInput(['maxlength' => true, 'readOnly' => true]) ?>
    <?= $form->field($model, 'fio')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?=$form->field($model, 'status_id')->dropDownList($statuses);?>

    <label>Cумма (без скидки): <?=number_format($model->sum + $model->discount, 2, ',', ' ')?> р.</label><br>
    <?php if ($model->discount_id) { ?>
        <label>Cумма (с учетом скидки): <?=number_format($model->sum, 2, ',', ' ')?> р.</label><br>
        <label>Cумма скидки: <?=number_format($model->discount, 2, ',', ' ')?> р. </label><br>
        <label>Промокод : <a href="<?=Url::to(['/admin/discount/view', 'id' => $model->discount_id ])?>"><?=$model->getDiscount()->one()->code?></a></label><br>
    <?php } else { ?>
        <label>Скидки нет.</label><br>
    <?php } ?>
    <?php if ($model->delivery_cost > 0) { ?>
        <label>Стоимость доставки: <?=number_format($model->delivery_cost, 2, ',', ' ')?> р.</label><br>
        <label>Итого к оплате: <?=number_format($model->delivery_cost + $model->sum, 2, ',', ' ')?> р.</label><br>
    <?php } ?>

    <?php if(isset($values) && !empty($values)){?>
        <h3>Продукты</h3>
        <?php foreach($values as $obValue){ ?>
            <label><?=$obValue->product->name;?></label><br>
            <label>Количество</label>
            <input class="form-control" name="products[<?=$obValue->product_id;?>][count]" value="<?=$obValue->count?>"><br>
            <label>Цена</label>
            <input class="form-control" name="products[<?=$obValue->product_id;?>][price]" value="<?=$obValue->price?>"><br>
            <label>Цена по скидке</label>
            <input class="form-control" name="products[<?=$obValue->product_id;?>][price_discount]" value="<?=$obValue->price_discount?>"><br>
        <?php }?>

    <?php } ?>

    <?php if($model->status->code != OrderStatus::STATUS_CODE_COMPLETE
        && $model->status->code != OrderStatus::STATUS_CODE_REJECT) { ?>
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
    <?php } ?>
    <?php ActiveForm::end(); ?>

</div>
