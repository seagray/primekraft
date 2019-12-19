<?php

use app\modules\admin\components\AdminTinyMce;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'category_id')->dropDownList(\app\models\Category::getAllPublicList()) ?>

    <?= $form->field($model, 'portions_count')->textInput() ?>

    <?= $form->field($model, 'weight')->textInput() ?>

    <?= $form->field($model, 'description')->widget(AdminTinyMce::className()) ?>

    <?php
    $url_input = function($prop) use ($form, $model) {
        $field = $form->field($model, $prop)->textInput(['maxlength' => true]);
        if ($model->{$prop} && !$model->{$prop . '_http_ok'}) {
            $field->error('test')->hint('Магазин вернул код 404');
        }
        return $field;
    }
    ?>
    <?= $url_input('ozon_url') ?>
    <?= $url_input('ulmart_url') ?>
    <?= $url_input('wildberries_url') ?>

    <?php if($model->images) {?>
        <div class="row">
        <?php foreach (json_decode($model->images, true) as $image) { ?>
            <div class="col-sm-2">
                <img src="<?= Yii::getAlias('@web') . $image ?>" width="200">
                <br>
                <a href="<?= Url::to(['/admin/product/remove-image', 'id' => $model->id, 'url' => $image]) ?>" class="text-danger confirm-delete" title="Удалить">Удалить</a>
            </div>
        <?php } ?>
        </div>
    <?php }?>
    <?= $form->field($model, 'images[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

    <?= $form->field($model, 'available')->checkbox() ?>

    <?= $form->field($model, 'public')->checkbox() ?>

    <?= $form->field($model, 'ord')->textInput() ?>

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
