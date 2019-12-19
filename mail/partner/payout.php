<?php
/**
 * @var \app\models\Payout $model
 */
use yii\helpers\Html;

?>

Ваша заявка №<?=$model->id?> на вывод средств переведена в статус "<?=Html::encode($model->getStatusText())?>"
