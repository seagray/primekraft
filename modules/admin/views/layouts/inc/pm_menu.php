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
            <li class="dropdown<?=($activePage == 'shop' ? ' active' : '')?>">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Магазин<span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="<?=url('order/')?>">Заказы</a></li>
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
        </ul>
        <div class="navbar-header">
            <a class="navbar-brand" href="<?=Url::to(['/site/logout'])?>">Выйти</a>
        </div>
    </div>
</nav>