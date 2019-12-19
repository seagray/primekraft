<?php
/**
* @var $this \yii\web\View
 */
use app\models\Address;
?>
<div class='wrapper'><!-- Боковая навигация и контентная часть -->
    <div class="group">
        <article class="content"><!-- Контент -->
            <?php if (isset($this->context->h1) && !empty($this->context->h1)) { ?>
                <h1><?=\yii\helpers\Html::encode($this->context->h1)?></h1>
            <?php } else { ?>
                <h1>Контактная  информация</h1>
            <?php } ?>
        </article>
    </div>
</div>
<!-- Блок с сертификатами -->
<div class="colorBlock contacts">
    <div class='wrapper'>
        <div class="lefter col-sm-6">
            <div class="contact_Info">
                <h5>наш офис</h5>
                <div class="addr">
                    <img alt="" src="<?=Yii::getAlias('@web/img/office.png')?>">
                    <p><?=Address::getOffice()->description?><br>
                        <span class="js-office" data-latitude="<?=Address::getOffice()->latitude?>" data-longitude="<?=Address::getOffice()->longitude?>"><?=Address::getOffice()->address?></span>
                    </p>
                </div>
                <h5>телефон</h5>
                <a href="tel:<?=Address::getOffice()->getPhoneNumber()?>" class='contact_tel'><?=Address::getOffice()->phones?></a>
                <h5>E-mail</h5>
                <a href="mailto:<?=Address::getOffice()->email?>" class='contact_email'><?=Address::getOffice()->email?></a>
                <a href="mailto:info@primekraft.ru" class="contact_email">info@primekraft.ru</a>
                <?=\app\models\Content::text("contacts_additional_info")?>
                <div class="soc_icons contacts"><!-- noindex -->
                    <!--                    <i><a href="#" target='_blank' class="fa fa-twitter" rel="nofollow"></a></i>-->
                    <i><a href="https://www.instagram.com/prime_kraft/" target='_blank' class="fa fa-instagram" rel="nofollow"></a></i>
                    <i><a href="https://vk.com/primekraft" target='_blank' class="fa fa-vk" rel="nofollow"></a></i>
                    <i><a href="https://www.facebook.com/primekraftru/" target='_blank' class="fa fa-facebook" rel="nofollow"></a></i>
                </div><!-- /noindex -->
            </div>
        </div>
        <div class="righter col-sm-6">
            <?=$this->renderFile('@app/views/layouts/inc/feedback_form.php', ['css_class' => 'static_Form', 'ya_target' => 'contact-form'])?>
        </div>
    </div>
</div>
<!-- Блок с сертификатами END -->