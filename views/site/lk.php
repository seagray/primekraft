<?php
use yii\helpers\Url;
use app\models\Content;
?>
<div class='wrapper'><!-- Боковая навигация и контентная часть -->
    <div class="group">
		<div class="lk">
			<aside class="sidebar-login col-xs-12">
				<!-- Breadcrumbs -->
				<aside class="breadcrumbs">
                            <span>
                                <a href="<?=Url::toRoute('site/index')?>">Главная</a>
                            </span>
                            <span>
                                <a href="<?=Url::toRoute('catalogue/index')?>">Каталог</a>
                            </span>
				</aside>
				<!-- Breadcrumbs END -->
				<div class="formLog">
					<div class="login">
						<a href="#"><span>Выйти</span> <i class="fa fa-sign-out"></i></a>
					</div>
					<span class="couch-name">Сергей Миронов</span>
					<select class="formLog-select" onchange="document.location=this.options[this.selectedIndex].value">
						<option selected="selected" value="<?= Url::toRoute(['site/page', 'view' => 'lk']) ?>">Личный кабинет</option>
						<option value="<?= Url::toRoute(['site/page', 'view' => 'lk_order']) ?>">Заказы</option>
						<option value="">Заявки</option>
						<option value="<?= Url::toRoute(['site/page', 'view' => 'lk_score']) ?>">Детализация счета</option>
					</select>
					<nav class="lk-nav">
						<a href="<?= Url::toRoute(['site/page', 'view' => 'lk']) ?>" class="active">Личный кабинет</a>
						<a href="<?= Url::toRoute(['site/page', 'view' => 'lk_order']) ?>">Заказы</a>
						<a href="#">Заявки</a>
						<a href="<?= Url::toRoute(['site/page', 'view' => 'lk_score']) ?>">Детализация счета</a>
					</nav>
				</div>
			</aside>
			<article class="content"><!-- Контент -->
				<?php if (isset($this->context->h1) && !empty($this->context->h1)) { ?>
					<h1><?=\yii\helpers\Html::encode($this->context->h1)?></h1>
				<?php } else { ?>
					<h1>Личный кабинет</h1>
				<?php } ?>
				<div class="personalInfo">
					<div class="promocodeInput">
						<span>Промокод</span>
						<p>Вы можете изменить промокод до того момента пока первый покупатель не воспользуется им для получения скидки на заказ</p>
						<div class="addPromocode">
							<input type="text">
							<div class="button_link--default">
								<a href="#" class="button_link"><span>изменить</span></a>
							</div>
						</div>
					</div>
					<div class="promocodePrice">
						<span>Личный счет</span>
						<div class="promocodePrice-row">
							<span class="promocodePrice-text">Состояние счета:</span>
							<span class="promocodePrice-price"><span>3 025, 62</span> p.</span>
						</div>
						<div class="promocodePrice-row">
							<span class="promocodePrice-text">Доступно для вывода:</span>
							<span class="promocodePrice-price"><span>3 000, 00</span> p.</span>
							<div class="button_link--default">
								<a href="#" class="button_link"><span>вывести</span></a>
							</div>
						</div>
						<div class="promocodePrice-row">
							<span class="promocodePrice-text">Текущие операции:</span>
							<span class="promocodePrice-price"><span class="empty">нет</span></span>
						</div>
					</div>
				</div>
			</article>
		</div>
    </div>
</div>
