<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\forms\ResetPasswordForm */

use yii\bootstrap\ActiveForm;

$this->title = 'Введите новый пароль';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='wrapper'><!-- Боковая навигация и контентная часть -->
    <div class="group">
        <article class="content"><!-- Контент -->
            <div class='main_production'>
                <div class='group'>
                    <div class="site-login">
                        <?php if (!$failToken) {  ?>
                            <?php if (isset($this->context->h1) && !empty($this->context->h1)) { ?>
                                <h1><?=\yii\helpers\Html::encode($this->context->h1)?></h1>
                            <?php } else { ?>
                                <h1><?=\yii\helpers\Html::encode($this->title)?></h1>
                            <?php } ?>
                            <form id="new-pass-form" class="form-horizontal notLogin js-ajax-form" method="post" data-title="Пароль изменен!" data-content="Новый пароль выслан на Вашу почту.">
                                <div class="form-group section_Input">
                                    <label><b>Пароль</b></label>
                                    <input type="password" class="form-control" name="password" autofocus="">
                                </div>
                                <div class="form-group section_Input">
                                    <label><b>Пароль повторно</b></label>
                                    <input type="password" class="form-control" name="password_repeat" autofocus="">
                                </div>
                                <br>
                                <div class="form-group">
                                    <div class="button_link--default">
                                        <button type="submit" class="block-field__button--uppercase button_link btn-primary js-pass-btn" name="login-button">
                                            <span>Сохранить</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        <?php } else { ?>
                            <h1>Неверная ссылка</h1>
                            <div>Вы перешли по недействительной ссылке смены пароля. Запросите восстановление повторно.</div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </article>
    </div>
</div>

