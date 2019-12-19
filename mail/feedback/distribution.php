<?php
/**
 * @var $form \app\forms\DistributionForm
 */
use yii\helpers\Html;

?>

Телефон: <?=Html::encode($form->phone)?><br />
Email: <?=Html::encode($form->email)?><br />
Город <?=Html::encode($form->city)?><br />
Форма собственности: <?=Html::encode($form->obj)?><br />
<?php if ($form->shop) { ?>
Магазин <?=Html::encode($form->shop)?><br />
<?php } ?>

<?php if ($form->company) { ?>
Компания <?=Html::encode($form->company)?><br />
<?php } ?>

Сообщение:<br />
<?=Html::encode($form->message)?>

*-------------------*