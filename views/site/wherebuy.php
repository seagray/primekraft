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
                <h1>Где купить</h1>
            <?php } ?>
        </article>
    </div>
</div>
<!-- Блок с сертификатами -->
<div class="where-to-buy content">
    <div class='wrapper'>
        <p>Команда Prime Kraft благодарит Вас за проявленный интерес к нашему спортивному питанию и надеется, что вы останетесь довольны самой продукцией, и что не менее важно, условиями ее приобретения!</p>
         <p>Для того чтобы вы могли приобрести понравившиеся товары Prime Kraft не только быстро, но и выгодно, мы подключили к работе наших партнеров – среди них многими любимые и работающие по всей России магазины <b>OZON</b>, <b>WILDBERRIES</b>, <b>ULMART</b>, <b>FITNESSBAR</b>, <b>5LB</b> и другие специализированные интернет-ритейлеры. Также продукцию Prime Kraft вы можете найти в любом продуктовом гипермаркете розничной сети <b>ЛЕНТА</b> в своем регионе. Почему это удобно? Потому что вы получаете возможность приобрести нашу продукцию практически в любом регионе нашей страны, выгодные цены и скидки, а также удобные варианты оплаты и доставки.</p>
        <img src="<?= Yii::getAlias('@web/img/ozon.png') ?>" alt="">
        <h2>Продукция Prime Kraft на <a href="https://www.ozon.ru/?context=search&text=prime+kraft&group=div_bs" target="_blank" rel="nofollow">ozon.ru</a></h2>
        <p>Условия работы:</p>
        <ul>
            <li>время работы: круглосуточно</li>
            <li>оплата: банковской картой при получении и на сайте, расчет наличными, apple pay, электронные деньги, банковский перевод, подарочный сертификат, покупка в кредит, личный счет</li>
            <li>доставка: пункты выдачи, курьерская доставка, постоматы, почта России</li>
            <li>стоимость доставки: определяется исходя из общей суммы и веса при оформлении заказа (минимально - от 99 рублей при заказе в пункт самовывоза)</li>
        </ul>
        <img src="<?= Yii::getAlias('@web/img/wildberries.png') ?>" alt="">
        <h2>Продукция Prime Kraft на <a href="https://www.wildberries.ru/brands/prime-kraft" target="_blank" rel="nofollow">wildberries.ru</a></h2>
        <p>Условия работы:</p>
        <ul>
            <li>время работы: круглосуточно</li>
            <li>оплата: расчет наличными, электронные платежи, рассрочка, личный счет </li>
            <li>оплата: расчет наличными, электронные платежи, рассрочка, личный счет </li>
            <li>стоимость доставки: бесплатно</li>
        </ul>
        <img src="<?= Yii::getAlias('@web/img/ulmart.png') ?>" alt="">
        <h2>Продукция Prime Kraft на <a href="https://www.ulmart.ru/search?string=Prime+Kraft&rootCategory=93793&sort=6" target="_blank" rel="nofollow">ulmart.ru</a></h2>
        <p>Условия работы:</p>
        <ul>
            <li>время работы: круглосуточно</li>
            <li>оплата: наличными и банковской картой при получении, электронные деньги, банковские карты на сайте, в кредит, бонусные баллы, подарочные сертификаты</li>
            <li>доставка: пункты самовывоза, курьерская доставка (стандартная и день в день)</li>
            <li>стоимость доставки: пункты самовывоза - бесплатно, доставка "день в день" - 590 рублей, стандартная доставка - рассчитывается индивидуально, в зависимости от выбранного интервала времени</li>
        </ul>
    </div>
</div>
<!-- Блок с сертификатами END -->