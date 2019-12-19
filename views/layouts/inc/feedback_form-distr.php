<?php
use yii\helpers\Url;
$ya_target = isset($ya_target) ? $ya_target : "";
$css_class = isset($css_class) ? $css_class : "";
?>

<form action="<?=Url::toRoute('feedback/distribution')?>" method="post" class='<?=$css_class?>'  data-title="Сообщение отправлено!" data-content="Скоро наши специалисты свяжутся с Вами.">
	<input type="hidden" name="ya-target" value="<?=$ya_target?>" />
	<h3>напишите нам</h3>
	<div class="section_Input">
		<input type="tel" placeholder="Телефон*" name='phone'>
	</div>
	<div class="section_Input">
		<input type="text" placeholder="E-mail" name='email'>
	</div>
	<div class="section_Input">
		<input type="text" placeholder="Город" name='city'>
	</div>
	<div class="section_Input">
		<p class="who">Форма собственности:</p>
		<label class="people-obj">
			<input type="radio" name="obj" value="Юр. лицо">
			<span></span>
			<span class="people-text">Юр. лицо</span>
		</label>
		<label class="people-obj">
			<input type="radio" name="obj" value="ИП">
			<span></span>
			<span class="people-text">ИП</span>
		</label>
		<label class="people-obj">
			<input type="radio" name="obj" value="Физ. лицо">
			<span></span>
			<span class="people-text">Физ. лицо</span>
		</label>
	</div>
	<div class="section_Input">
		<input type="text" placeholder="Магазин" name='shop'>
	</div>
	<div class="section_Input">
		<input type="text" placeholder="Название компании" name='company'>
	</div>
	<div class="section_Input">
		<textarea placeholder="Сообщение*" name='message'></textarea>
	</div>
	<div class="button_link--default">
		<button type='submit' class='button_link'><span>Отправить</span></button>
	</div>
</form>