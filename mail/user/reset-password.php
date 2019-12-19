<?php
/**
 * @var \app\models\User $model
 * @var string $restoreUrl
 * @var integer $expire
 */
use yii\helpers\Html;
?>

Вы запросили смену пароля на сайте primekraft.ru<br />
Логин: <?=Html::encode($model->email)?><br />
Чтобы указать новый пароль перейдите по ссылке: <a href="<?=$restoreUrl?>"><?=$restoreUrl?></a><br />
Если Вы не отправляли запрос, то проигнорируйте и удалите данное письмо.<br/>
Ссылка действительна в течении <?=\MessageFormatter::formatMessage(\Yii::$app->language, '{n, plural,one{# дня} few{# дней} many{# дней} other{# дней}}', ['n' => $expire])?> на одно восстановление пароля.<br/>
