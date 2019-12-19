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
						<option value="<?= Url::toRoute(['site/page', 'view' => 'lk']) ?>">Личный кабинет</option>
						<option value="<?= Url::toRoute(['site/page', 'view' => 'lk_order']) ?>">Заказы</option>
						<option value="">Заявки</option>
						<option selected="selected" value="<?= Url::toRoute(['site/page', 'view' => 'lk_score']) ?>">Детализация счета</option>
					</select>
					<nav class="lk-nav">
						<a href="<?= Url::toRoute(['site/page', 'view' => 'lk']) ?>">Личный кабинет</a>
						<a href="<?= Url::toRoute(['site/page', 'view' => 'lk_order']) ?>">Заказы</a>
						<a href="#">Заявки</a>
						<a href="<?= Url::toRoute(['site/page', 'view' => 'lk_score']) ?>" class="active">Детализация счета</a>
					</nav>
				</div>
			</aside>
			<article class="content"><!-- Контент -->
				<?php if (isset($this->context->h1) && !empty($this->context->h1)) { ?>
					<h1><?=\yii\helpers\Html::encode($this->context->h1)?></h1>
				<?php } else { ?>
					<h1>Детализация счёта</h1>
				<?php } ?>
				<div class="personalInfo">
					<div class="lk_radio--group">
						<label onclick="window.location = '<?= Url::toRoute(['site/page', 'view' => 'lk_order']) ?>'">
							<input type="radio" name="time">
							<span></span>
							<span class="lk_radio--text">за все время</span>
						</label>
						<label>
							<input type="radio" name="time" checked="checked">
							<span></span>
							<span class="lk_radio--text">за период</span>
						</label>
					</div>
					<div class="period">
						<input type="text">
						<span>—</span>
						<input type="text">
						<div class="button_link--default">
							<a href="#" class="button_link"><span>применить</span><i></i></a>
						</div>
					</div>
					<div class="info_score">
						<div class="info_score_row">
							<div class="text">Зачислено</div>
							<div class="price"><span>280,04</span> р.</div>
						</div>
						<div class="info_score_row">
							<div class="text">Выведено</div>
							<div class="price"><span>3 000,00</span> р.</div>
						</div>
					</div>
					<div class="lk_table score">
						<table>
							<thead>
								<tr>
									<th><span class="sort">дата<i class="fa fa-sort-desc"></i></span></th>
									<th>описание</i></th>
									<th class="last">Сумма</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>14.09.2016</td>
									<td>оплачен заказ от 13.00.2016</td>
									<td class="last"><span>+70,02</span> р.</td>
								</tr>
								<tr>
									<td>13.09.2016</td>
									<td class="true">выведено </td>
									<td class="last true"><span>- 3 000,0</span> р.</td>
								</tr>
								<tr>
									<td>12.09.2016</td>
									<td>оплачен</td>
									<td class="last"><span>+ 70,02</span> р.</td>
								</tr>
								<tr>
									<td>11.09.2016</td>
									<td>оплачен заказ от 11.09.2016</td>
									<td class="last"><span>+ 70,02</span> р.</td>
								</tr>
								<tr>
									<td>10.09.2016</td>
									<td>оплачен заказ от 11.09.2016</td>
									<td class="last"><span>+ 70,02</span> р.</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</article>
		</div>
    </div>
</div>
