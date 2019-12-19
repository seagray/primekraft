<?php
/**
 * @var \app\models\Payout $model
 */
use yii\helpers\Html;

?>

Новая заявка №<?=$model->id?> на вывод средств от пользователя <?=Html::encode($model->user)?>
