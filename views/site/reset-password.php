<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\forms\ResetPasswordForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Восстановление пароля';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='wrapper'><!-- Боковая навигация и контентная часть -->
    <div class="group">
        <article class="content"><!-- Контент -->
            <div class='main_production'>
                <?php if (isset($this->context->h1) && !empty($this->context->h1)) { ?>
                    <h1><?=\yii\helpers\Html::encode($this->context->h1)?></h1>
                <?php } else { ?>
                    <h1><?=\yii\helpers\Html::encode($this->title)?></h1>
                <?php } ?>
                <div class='group'>
                    <div class="site-login">
                        <?php if ($sent) { ?>
                            Инструкции для смены пароля отправлены на указанный Email
                        <?php } else {?>
                            <form id="login-form" class="form-horizontal notLogin" action="<?=Url::to('/site/reset-password')?>" method="post">
                                <div class="form-group field-resetpasswordform-username required has-error">
                                    <label><b>Логин</b></label>
                                    <?php echo \yii\helpers\Html::activeInput('text', $model, 'username'); ?>
                                    <?php echo \yii\helpers\Html::error($model, 'username', ['class' => 'error']); ?>
                                </div>
                                <br><br>
                                <div class="form-group">
                                    <div class="button_link--default">
                                        <button class="block-field__button--uppercase button_link btn-primary" name="login-button">
                                            <span>Отправить запрос</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </article>
    </div>
</div>

