<?php
use yii\helpers\Url;
$ya_target = isset($ya_target) ? $ya_target : "";
$css_class = isset($css_class) ? $css_class : "";
?>
<div class="<?=$css_class?>">
    <h2>Подробности об условии доставки</h2>
    <p>Приобретая спортивные добавки Primekraft, вы всегда можете выбрать самый подходящий для вас вариант доставки вашего заказа. Обращаем внимание, что при сумме заказа от 2 500 рублей мы доставляем вашу покупку бесплатно. При сумме менее 2 500 рублей действуют следующие тарифы:</p>
    <div class="media-sector">
        <span class="media-img">
            <img src="<?= Yii::getAlias('@web/img/delivery-icon.png') ?>" alt="Курьерская служба (по Санкт-Петербургу и Москве)" title="Курьерская служба (по Санкт-Петербургу и Москве)">
        </span>
        <span class="media-text up-media">
            Курьерская служба (по Санкт-Петербургу и Москве)
        </span>
    </div>
    <ul>
        <li>по Санкт-Петербургу в пределах КАД: от 200 рублей;</li>
        <li>за пределами КАД: оплачивается каждый дополнительный километр в размере 30 рублей;</li>
        <li>по Москве в пределах МКАД: от 260 рублей;</li>
        <li>за пределами МКАД : оплачивается каждый дополнительный километр в размере 30 рублей.</li>
    </ul>
    <h3>Регионы:</h3>
    <div class="media-sector">
        <span class="media-img">
            <img src="<?= Yii::getAlias('@web/img/pochta.png') ?>" alt="Курьерская служба (по Санкт-Петербургу и Москве)" title="Курьерская служба (по Санкт-Петербургу и Москве)">
        </span>
        <span class="media-text">
            Почта России – <a href="https://www.pochta.ru/parcels" target="_blank" rel="nofollow">ТАРИФЫ</a>
        </span>
    </div>
    <div class="media-sector">
        <span class="media-img">
            <img src="<?= Yii::getAlias('@web/img/dpd.png') ?>" alt="Курьерская служба (по Санкт-Петербургу и Москве)" title="Курьерская служба (по Санкт-Петербургу и Москве)">
        </span>
        <span class="media-text">
            DPD - <a href="http://www.dpd.ru/dpd/uslugi-i-tarify/dostavka-po-rossii.do2" target="_blank" rel="nofollow">ТАРИФЫ</a>
        </span>
    </div>
    <div class="media-sector">
        <span class="media-img">
            <img src="<?= Yii::getAlias('@web/img/ems.png') ?>" alt="Курьерская служба (по Санкт-Петербургу и Москве)" title="Курьерская служба (по Санкт-Петербургу и Москве)">
        </span>
        <span class="media-text">
            EMS - <a href="http://www.emspost.ru/ru/" target="_blank" rel="nofollow">ТАРИФЫ</a>
        </span>
    </div>
    <p>*Рассчитать стоимость доставки вы можете по телефонам или на сайтах служб доставки.</p>
    <p>Также вы можете воспользоваться бесплатной услугой самовывоза из офиса ( доступно для жителей Санкт-Петербурга).</p>
</div>
