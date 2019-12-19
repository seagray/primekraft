<?php
/**
 * @var \app\models\Transaction $model
 */
use yii\helpers\Html;

?>

<?=($model->direction == 1 ? 'Начисление':'Списание')?> средств в размере <?=Html::encode($model->sum)?> руб. Причина: <?=Html::encode($model->comment)?>

