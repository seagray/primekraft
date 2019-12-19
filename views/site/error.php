<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

?>
<div class="site-error">
	<div class="wrapper">
		<?php if (YII_DEBUG) { ?>
			<p class="error404">
				<span class="er404"><?=$name?></span>
				<span class="text404"><?=$message?></span>
			</p>
		<?php } else { ?>
			<p class="error404">
				<span class="er404">404</span>
				<span class="text404">Страница не найдена</span>
			</p>
		<?php } ?>
	</div>
</div>
