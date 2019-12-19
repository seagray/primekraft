<?php
use yii\helpers\Url;

/**
 * @param $path
 * @return string
 */
function url($path)
{
    return Yii::getAlias('@web/admin/') . $path;
}
$activePage = isset(Yii::$app->params['activePage']) ? Yii::$app->params['activePage'] : null;

?>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="/">Перейти на сайт</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="dropdown<?=($activePage == 'content' ? ' active' : '')?>">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Контент<span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="<?=url('news/')?>">Новости</a></li>
                    <li><a href="<?=url('article/')?>">Статьи</a></li>
                    <li><a href="<?=url('feedback/')?>">Заполненные формы</a></li>
                    <li><a href="<?=url('distribution-request/')?>">Заявки дистрибьторов</a></li>
                    <!--                <li><a href="--><?//=url('team/')?><!--">Команда</a></li>-->
                    <li><a href="<?=url('content/')?>">Тексты</a></li>
                    <li><a href="<?=url('seo-ignite/')?>">SEO</a></li>
                    <li><a href="<?=url('seo-ignite/images')?>">SEO изображений</a></li>
                </ul>
            </li>
            <li class="dropdown<?=($activePage == 'map' ? ' active' : '')?>">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Карта<span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="<?=url('city/')?>">Города</a></li>
                    <li><a href="<?=url('cityobjects/')?>">Метро и районы</a></li>
                    <li><a href="<?=url('address/')?>">Магазины</a></li>
                </ul>
            </li>
            <li class="dropdown<?=($activePage == 'catalogue' ? ' active' : '')?>">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Каталог<span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="<?=url('flavor/')?>">Вкусы</a></li>
                    <li><a href="<?=url('category/')?>">Категория</a></li>
                    <li><a href="<?=url('product/')?>">Продукция</a></li>
                    <li><a href="<?=url('portion/')?>">Порции</a></li>
                    <li><a href="<?=url('portionproperties/')?>">Свойства порций</a></li>
                    <li><a href="<?=url('catalogue-tags/')?>">Группы товаров</a></li>
                </ul>
            </li>
            <li class="dropdown<?=($activePage == 'shop' ? ' active' : '')?>">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Магазин<span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="<?=url('order/')?>">Заказы</a></li>
                    <li><a href="<?=url('invoice/')?>">Счета</a></li>
                </ul>
            </li>
            <li class="dropdown<?=($activePage == 'partner' ? ' active' : '')?>">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Партнерка<span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="<?=url('vacancy/')?>">Заявки на регистрацию</a></li>
                    <li><a href="<?=url('payout/')?>">Выплаты</a></li>
                    <li><a href="<?=url('transaction/')?>">Начисления</a></li>
                    <li><a href="<?=url('discount/')?>">Промокоды</a></li>
                </ul>
            </li>
            <li class="dropdown<?=($activePage == 'system' ? ' active' : '')?>">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Система<span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="<?=url('user/')?>">Пользователи</a></li>
                </ul>
            </li>
        </ul>
        <div class="navbar-header">
            <a class="navbar-brand" href="<?=Url::to(['/site/logout'])?>">Выйти</a>
        </div>
    </div>
</nav>