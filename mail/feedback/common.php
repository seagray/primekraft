<?php
/**
 * @var $form \app\forms\FeedbackForm
 */
use yii\helpers\Html;
?>

Телефон: <?=Html::encode($form->phone)?><br />
Email: <?=Html::encode($form->email)?><br />
Сообщение:<br />
<?=Html::encode($form->message)?>
*-------------------*