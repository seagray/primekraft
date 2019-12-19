<?php
use yii\helpers\Url;
$ya_target = isset($ya_target) ? $ya_target : "";
$css_class = isset($css_class) ? $css_class : "";
?>
<form action="<?=Url::toRoute('feedback/send')?>" method="post" class='<?=$css_class?>' data-title="Сообщение отправлено!" data-content="Скоро наши специалисты свяжутся с Вами.">
    <input type="hidden" name="ya-target" value="<?=$ya_target?>" />
    <h3>напишите нам</h3>
    <div class="section_Input">
        <input type="tel" placeholder="Телефон*" name='phone'>
    </div>
    <div class="section_Input">
        <input type="text" placeholder="E-mail" name='email'>
    </div>
    <div class="section_Input">
        <textarea placeholder="Сообщение*" name='message'></textarea>
    </div>
    <div class="button_link--default">
        <button type='submit' class='button_link'><span>Отправить</span></button>
    </div>
</form>