<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = 'Авторизация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='wrapper'><!-- Боковая навигация и контентная часть -->
    <div class="group">
        <article class="content"><!-- Контент -->
            <div class='main_production'>
                <?php if (isset($this->context->h1) && !empty($this->context->h1)) { ?>
                    <h1><?=\yii\helpers\Html::encode($this->context->h1)?></h1>
                <?php } else { ?>
                    <h1>Авторизация</h1>
                <?php } ?>
                <div class='group'>
                    <div class="site-login">
                        <form id="login-form" class="form-horizontal notLogin" action="/site/login" method="post">
                            <div class="form-group field-loginform-username required has-success">
                                <label><b>Имя пользователя</b></label>
                                <?php echo \yii\helpers\Html::activeInput('text', $model, 'username'); ?>
                                <?php echo \yii\helpers\Html::error($model, 'username', ['class' => 'error']); ?>
                            </div>
                            <br>
                            <div class="form-group field-loginform-password required has-success">
                                <label><b>Пароль:</b></label>
                                <?php echo \yii\helpers\Html::activeInput('password', $model, 'password'); ?>
                                <?php echo \yii\helpers\Html::error($model, 'password', ['class' => 'error']); ?>
                            </div>
                            <div class="form-group field-loginform-password-reset">
                                <div class="help-block"><a href="/site/reset-password">Восстановить пароль</a></div>
                            </div><br>

                            <div class="form-group">
                                <div class="button_link--default">
                                    <button class="block-field__button--uppercase button_link btn-primary" name="login-button">
                                        <span>Авторизоваться</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </article>
    </div>
</div>

