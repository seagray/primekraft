<?php
/**
 * @var \app\models\Vacancy $model
 */
use yii\helpers\Html;
?>

Новая регистрация на сайте primekraft.ru<br/>

Имя: <?=Html::encode($model->name)?><br />
Телефон: <?=Html::encode($model->phone)?><br />
Email: <?=Html::encode($model->email)?><br />
<?php if(!empty($model->vk_profile)) { ?>
    Профиль ВКонтакте: <?=Html::encode($model->vk_profile)?><br />
<?php } ?>
<?php if(!empty($model->instagram_profile)) { ?>
    Профиль Instagram: <?=Html::encode($model->instagram_profile)?><br />
<?php } ?>