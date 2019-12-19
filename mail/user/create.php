<?php
/**
 * @var \app\models\User $model
 * @var string $password
 */
use yii\helpers\Html;
?>

Создана учетная запись на primekraft.ru<br />
Для авторизации перейдите по ссылке: <a href="http://primekraft.ru/site/login">http://primekraft.ru/site/login</a><br />
Для входа на сайт используйте следующие реквизиты:<br />
Логин: <?=Html::encode($model->email)?><br />
Пароль: <?=Html::encode($password)?><br />