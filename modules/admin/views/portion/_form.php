<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\admin\components\AdminTinyMce;

/**
 * @var $this yii\web\View
 * @var $model app\models\Portion
 * @var $form yii\widgets\ActiveForm
 * @var $products array
 * @var $flavors array
 */
?>

<div class="portion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'product_id')->dropDownList($products) ?>
    <?= $form->field($model, 'flavor_id')->dropDownList($flavors) ?>

    <?= $form->field($model, 'portion_weight')->textInput() ?>

    <?= $form->field($model, 'description')->widget(AdminTinyMce::className()) ?>

    <?= $form->field($model, 'energy')->textInput(['class' => 'form-control nutrition-facts']) ?>
    <?= $form->field($model, 'protein')->textInput(['class' => 'form-control nutrition-facts']) ?>
    <?= $form->field($model, 'fat')->textInput(['class' => 'form-control nutrition-facts']) ?>
    <?= $form->field($model, 'carbs')->textInput(['class' => 'form-control nutrition-facts']) ?>

    <?= $form->field($model, 'energy_per_100')->textInput() ?>
    <?= $form->field($model, 'protein_per_100')->textInput() ?>
    <?= $form->field($model, 'fat_per_100')->textInput() ?>
    <?= $form->field($model, 'carbs_per_100')->textInput() ?>

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
