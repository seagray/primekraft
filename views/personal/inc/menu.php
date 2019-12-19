<?php
use yii\helpers\Url;
$activePage = isset(\Yii::$app->params['personal-activePage']) ? \Yii::$app->params['personal-activePage'] : null;
?>

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
            <a href="/site/logout"><span>Выйти</span> <i class="fa fa-sign-out"></i></a>
        </div>
        <span class="couch-name"><?=Yii::$app->user->identity->nickname;?></span>
        <select class="formLog-select" onchange="document.location=this.options[this.selectedIndex].value">
            <option value="<?= Url::toRoute(['/personal']) ?>">Личный кабинет</option>
            <option value="<?= Url::toRoute(['/personal/orders']) ?>">Заказы по промокоду</option>
            <option value="<?= Url::toRoute(['/personal/payouts']) ?>">Вывод средств</option>
            <option value="<?= Url::toRoute(['/personal/transactions']) ?>">Детализация счета</option>
            <option value="<?= Url::toRoute(['/personal/referrals']) ?>">Рефералы</option>
        </select>
        <nav class="lk-nav">
            <a href="<?= Url::toRoute(['/personal']) ?>"<?=($activePage == 'index' ? ' class="active"' : '')?>>Личный кабинет</a>
            <a href="<?= Url::toRoute(['/personal/orders']) ?>"<?=($activePage == 'orders' ? ' class="active"' : '')?>>Заказы по промокоду</a>
            <a href="<?= Url::toRoute(['/personal/payouts']) ?>"<?=($activePage == 'payouts' ? ' class="active"' : '')?>>Вывод средств</a>
            <a href="<?= Url::toRoute(['/personal/transactions']) ?>"<?=($activePage == 'transactions' ? ' class="active"' : '')?>>Детализация счета</a>
            <a href="<?= Url::toRoute(['/personal/referrals']) ?>"<?=($activePage == 'referrals' ? ' class="active"' : '')?>>Рефералы</a>
        </nav>
    </div>
</aside>