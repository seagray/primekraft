<?php
/**
 * @var \app\models\User $model
 * @var string $resetUrl
 * @var string $password
 */
use yii\helpers\Html;
?>

Вы сменили пароль на сайте primekraft.ru<br/>
Логин: <?=Html::encode($model->email)?><br/>
Новый пароль: <?=Html::encode($password)?><br/>
Если Вы не меняли пароль, то настоятельно рекомендуем выполнить следующую инструкцию:<br/>
1. Сменить пароль данного почтового аккаунта, так как он мог быть скомпрометирован.<br/>
2. Запросить смену пароля на сайте primekraft.ru по ссылке <a href="<?=$resetUrl?>"><?=$resetUrl?></a><br/>
