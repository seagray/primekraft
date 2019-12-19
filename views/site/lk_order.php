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
						<option selected="selected" value="<?= Url::toRoute(['site/page', 'view' => 'lk_order']) ?>">Заказы</option>
						<option value="">Заявки</option>
						<option value="<?= Url::toRoute(['site/page', 'view' => 'lk_score']) ?>">Детализация счета</option>
					</select>
					<nav class="lk-nav">
						<a href="<?= Url::toRoute(['site/page', 'view' => 'lk']) ?>">Личный кабинет</a>
						<a href="<?= Url::toRoute(['site/page', 'view' => 'lk_order']) ?>" class="active">Заказы</a>
						<a href="#">Заявки</a>
						<a href="<?= Url::toRoute(['site/page', 'view' => 'lk_score']) ?>">Детализация счета</a>
					</nav>
				</div>
			</aside>
			<article class="content"><!-- Контент -->
				<?php if (isset($this->context->h1) && !empty($this->context->h1)) { ?>
					<h1><?=\yii\helpers\Html::encode($this->context->h1)?></h1>
				<?php } else { ?>
					<h1>Заказы</h1>
				<?php } ?>
				<div class="personalInfo">
					<div class="lk_radio--group">
						<label>
							<input type="radio" name="time" checked="checked">
							<span></span>
							<span class="lk_radio--text">за все время</span>
						</label>
						<label onclick="window.location = '<?= Url::toRoute(['site/page', 'view' => 'lk_score']) ?>'">
							<input type="radio" name="time">
							<span></span>
							<span class="lk_radio--text">за период</span>
						</label>
					</div>
					<div class="lk_table">
						<table>
							<thead>
								<tr>
									<th><span class="sort">дата<i class="fa fa-sort-desc"></i></span></th>
									<th><span class="sort">статус<i class="fa fa-sort-desc"></i></span></th>
									<th>отчисления</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>14.09.2016</td>
									<td class="true">оплачен</td>
									<td><span>65,50</span> р.</td>
								</tr>
								<tr>
									<td>13.09.2016</td>
									<td>не оплачен</td>
									<td><span>66,50</span> р.</td>
								</tr>
								<tr>
									<td>12.09.2016</td>
									<td class="true">оплачен</td>
									<td><span>67,50</span> р.</td>
								</tr>
								<tr>
									<td>11.09.2016</td>
									<td>не оплачен</td>
									<td><span>68,50</span> р.</td>
								</tr>
								<tr>
									<td>10.09.2016</td>
									<td>не оплачен</td>
									<td><span>69,50</span> р.</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</article>
		</div>
    </div>
</div>
