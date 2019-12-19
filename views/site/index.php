<?php
use \yii\helpers\Url;

?>
<?php $this->beginBlock('header') ?>
<header class='main_header'>
    <div class="main_header-slider">
        <div class="item">
            <img src="<?= Yii::getAlias('@web/img/slider/bunner2.jpg') ?>" alt="Micellar casein" title="Micellar casein">
            <div class="fixed_cont">
                <div class="wrapper">
                    <div class="group">
                        <div class="righter col-sm-12 col-xs-12 col-xxs-12">
                            <div class="soc_icons top"><!-- noindex -->
                                <?php /*
                                    <i><a href="#" target='_blank' class="fa fa-twitter" rel="nofollow"></a></i>
                                */ ?>
                                <i><a href="https://www.youtube.com/channel/UCOh5M9_jPtm8iLOfpnOWJbg" target='_blank' class="fa fa-youtube" rel="nofollow"></a></i>
                                <i><a href="https://www.instagram.com/prime_kraft/" target='_blank' class="fa fa-instagram" rel="nofollow"></a></i>
                                <i><a href="https://vk.com/primekraft" target='_blank' class="fa fa-vk" rel="nofollow"></a></i>
                                <i><a href="https://www.facebook.com/primekraftru/" target='_blank' class="fa fa-facebook" rel="nofollow"></a></i>
                            </div><!-- /noindex -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="item man">
            <img src="<?= Yii::getAlias('@web/img/onlyFon.jpg') ?>" alt="Micellar casein" title="Micellar casein">
            <div class="fixed_cont">
                <div class="wrapper">
                    <div class="group">
                        <!-- <div class='center col-md-12'>
                            <span class='header_title'>спортивное питание</span>
                        </div> -->
                        <div class="lefter col-sm-7 col-xs-6 col-xxs-12">
                            <!-- <img src="/img/logoMain.png" alt="" class='logo_main'> -->
                            <img src="/img/logoMainMobile.png" alt="" class='logo_main-mobile'>
                        </div>
                        <div class="righter col-sm-5 col-xs-6 col-xxs-12">
                            <div class="soc_icons top"><!-- noindex -->
                                <?php /*
                                    <i><a href="#" target='_blank' class="fa fa-twitter" rel="nofollow"></a></i>
								*/ ?>
								<i><a href="https://www.youtube.com/channel/UCOh5M9_jPtm8iLOfpnOWJbg" target='_blank' class="fa fa-youtube" rel="nofollow"></a></i>
                                <i><a href="https://www.instagram.com/prime_kraft/" target='_blank' class="fa fa-instagram" rel="nofollow"></a></i>
                                <i><a href="https://vk.com/primekraft" target='_blank' class="fa fa-vk" rel="nofollow"></a></i>
                                <i><a href="https://www.facebook.com/primekraftru/" target='_blank' class="fa fa-facebook" rel="nofollow"></a></i>
                            </div><!-- /noindex -->

                            <!-- <p></p> -->
                            <div class="button_link--default">
                                <a href="/production" class='button_link'><span>Перейти в каталог</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <img src="/img/banks_header.png" alt="" class='banks_header'>
        </div>
	</div>
</header>
<?php $this->endBlock() ?>

<?php
/**
 * @var $combobox \app\models\Category[]
 * @var $singletaste \app\models\Category[]
 */
use app\helpers\Image;
?>
    <div class='wrapper'><!-- каталог -->
        <div class="group">
            <article class="content"><!-- Контент -->
                <div class='main_production'>
                    <?php if (isset($this->context->h1) && !empty($this->context->h1)) { ?>
                        <h1><?=\yii\helpers\Html::encode($this->context->h1)?></h1>
                    <?php } else { ?>
                        <h1>Продукция</h1>
                    <?php } ?>
                    <div class='group'>
                        <?php foreach (\app\models\Category::findListByLines() as $line) {?>
                            <div class='main_production-wrap'>
                                <div class='group'>
                                    <?php foreach ($line as $cat) {?>
                                        <figure class="item_el col-sm-4 col-xs-6">
                                            <a href="<?=$cat->url?>">
                                                <div class="item_el-wrap">
                                                    <img src="<?= Yii::getAlias('@web') . Image::thumbnail($cat->image, 180, 190) ?>"  alt="<?=$cat->name?>" />
                                                    <h4><?=$cat->name?></h4>
                                                </div>
                                                <?=$cat->description?>
                                            </a>
                                        </figure>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </article>
        </div>
    </div>

    <!-- Блок с предложением -->
    <div class="colorBlockBg sert onMain">
        <div class='wrapper'><!-- дистрибьюторы -->
            <div class="group">
                <article class="content">
                    <div class="distributor">
                        <h2>Хотите стать дистрибьютором?</h2>
                        <div class="group">
                            <figure class="box">
                                <span class='dist_img'>
                                    <img src="<?= Yii::getAlias('@web/img/iso.png') ?>" alt="">
                                </span>
                                <figcaption>
                                    Производство сертифицировано по Европейскому стандарту
                                </figcaption>
                            </figure>
                            <figure class="box">
                                <span class='dist_img'>
                                    <img src="<?= Yii::getAlias('@web/img/retail.png') ?>" alt="">
                                </span>
                                <figcaption>
                                    Гибкие условия оплаты и доставки
                                </figcaption>
                            </figure>
                            <figure class="box">
                                <span class='dist_img'>
                                    <img src="<?= Yii::getAlias('@web/img/taste.png') ?>" alt="">
                                </span>
                                <figcaption>
                                    Постоянно расширяемая вкусовая линейка.
                                </figcaption>
                            </figure>
                            <figure class="box">
                                <span class='dist_img'>
                                    <img src="<?= Yii::getAlias('@web/img/low_price.png') ?>" alt="">
                                </span>
                                <figcaption>
                                    Низкая себестоимость делает продукты доступными для широкой аудитории
                                </figcaption>
                            </figure>
                            <figure class="box">
                                <span class='dist_img'>
                                    <img src="<?= Yii::getAlias('@web/img/unique.png') ?>" alt="">
                                </span>
                                <figcaption>
                                    Качественное сырье и уникальные рецептуры позволяют спортсменам добиваться наибольшего результата
                                </figcaption>
                            </figure>
                        </div>
                        <div class="button_link--default">
                            <a href="#modal-distr" class='button_link modal' data-ya-target="to-know-the-conditions"><span>узнать условия</span></a>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
    <!-- Блок с предложением END -->

    <div class='wrapper'><!-- дистрибьюторы -->
        <div class="group">
            <article class="content"><!-- Контент -->
                <div class="partners">
                    <h2>С нами работают</h2>
                    <div class="group">
                        <figure class="col-lg-4 col-md-4 col-sm-4 hidden-xs animated boxHidden">
                            <img src="<?= Yii::getAlias('@web/img/ozon.png') ?>" alt="">
                        </figure>
                        <figure class="col-lg-4 col-md-4 col-sm-4 hidden-xs animated boxHidden delay-02s">
                            <img src="<?= Yii::getAlias('@web/img/f-bar.png') ?>" alt="">
                        </figure>
                        <figure class="col-lg-4 col-md-4 col-sm-4 hidden-xs animated boxHidden delay-04s">
                            <img src="<?= Yii::getAlias('@web/img/wildberries.png') ?>" alt="">
                        </figure>
                    </div>
                    <div class="group">
                        <figure class="col-xs-6 visible-xs animated boxHidden">
                            <img src="<?= Yii::getAlias('@web/img/ozon.png') ?>" alt="">
                        </figure>
                        <figure class="col-xs-6 visible-xs animated boxHidden delay-02s">
                            <img src="<?= Yii::getAlias('@web/img/f-bar.png') ?>" alt="">
                        </figure>
                        <figure class="col-xs-6 visible-xs animated boxHidden delay-04s">
                            <img src="<?= Yii::getAlias('@web/img/wildberries.png') ?>" alt="">
                        </figure>
                        <figure class="col-lg-3 col-md-3 col-sm-3 col-xs-6 animated boxHidden delay-02s">
                            <img src="<?= Yii::getAlias('@web/img/online-trade.png') ?>" alt="">
                        </figure>
                        <figure class="col-lg-3 col-md-3 col-sm-3 col-xs-6 animated boxHidden delay-04s">
                            <img src="<?= Yii::getAlias('@web/img/5lb.png') ?>" alt="">
                        </figure>
                        <figure class="col-lg-3 col-md-3 col-sm-3 col-xs-6 animated boxHidden delay-06s">
                            <img src="<?= Yii::getAlias('@web/img/ulmart.png') ?>" alt="">
                        </figure>
                    </div>
                </div>
                <style>
                    .main-top-content{
                        margin-top: 50px;
                    }
                    .main-top-content p{
                        /*font-size:12px;*/
                        /*line-height: 14px;*/
                    }
                    .main-top-content h3{
                        text-align: center;
                    }
                </style>
                <div class="main-top-content">
                    <?=\app\models\Content::text("seo-main", "<h3>Новый бренд спортивного питания Prime Kraft</h3>
<p>Главный тренд сегодняшнего времени &ndash; стремление людей вести активный и здоровый образ жизни. Достижению этой цели способствует физическая нагрузка и, конечно, спортивное питание, подобранное в соответствии с конечной целью.</p>
<h3>Правильное спортивное питание</h3>
<p>Спортивное питание и добавки, предлагаемые сегодня как профессионалам, так и любителям, представляют собой комплекс полезных веществ, обогащенных витаминами и минералами. Прием качественного профессионального спортивного питания значительно повышает выносливость, трудоспособность и восстановление организма после тренировок спортсмена. Да, организм человека производит некоторое количество аминокислот, необходимых для поддержания стабильной работы всех его систем, однако при повышенных физических нагрузках, этого количества будет мало, а значит, восполнять недостаток потребуется как раз спортпитом.</p>
<p>Если вы желаете купить спортивное питание по доступным ценам и ищете сбалансированный продукт, который без вреда для здоровья позволит добиться желаемого результата или улучшить существующий, то спортивное питание Prime Kraft &ndash; это лучший выбор! Мы предлагаем спортивные добавки с широкой линейкой вкусов &ndash; подберите то, что понравится именно вам, чтобы раз и навсегда забыть об однообразии! Благодаря наличию собственного производства и использованию первоклассного сырья, наши клиенты могут купить спортивное питание отличного качества!</p>
<p>Для удобства использования мы предлагаем комплексное порционное спортивное питание и это, действительно, важный момент &ndash; вам не придется носить с собой тяжелые банки с мерными ложками. Необходимое количество самого лучшего российского спортивного питания от производителя уже упаковано в отдельный пакетик &ndash; просто разведите его водой!</p>
<h3>Заказать спортивное питание Prime Kraft</h3>
<p>Заказать вкусное спортивное питание онлайн по выгодным ценам Вы можете на нашем сайте, просто выбрав необходимые добавки и способ доставки. Нашим клиентам доступно спортивное питание с доставкой по России, самовывозом, курьерскими службами. При заказе на сумму свыше 2 500 рублей клиент получает бесплатную доставку спортивного питания.</p>
<p>Почему нам доверяют? Выверенный технологический процесс и строгий контроль качества выпускаемой продукции гарантирует, что клиент получит эффективный и полезный продукт, способный удовлетворить его запросам и целям.</p>
<p>Мы осуществляем продажу только безопасных спортивных добавок, заботясь о здоровье наших клиентов &ndash; в нашем ассортименте только то, что действительно необходимо для получения требуемой физической формы. Спортивное питание от Prime Kraft &ndash; это выгодные цены, скидки и акции, удобные варианты доставки и непревзойденное качество!</p>
<p>Достигайте новых вершин вместе со спортивным питанием Prime Kraft!</p>")?>
                </div>
            </article>
        </div>
    </div><!-- Контентная часть END -->

<?php /* Команда
<div class='wrapper'><!-- Контентная часть -->
    <div class="group">
        <article class="content"><!-- Контент -->
            <div class="team">
                <h2>Команда <span>PrimeKraft</span></h2>
                <div class='group'>
                    <figure class="item_el col-md-4 col-sm-4 col-xs-6">
                                        <span class='gran'>
                                            <div class='imit_img'>
                                                <img src="<?= Yii::getAlias('@web/img/man.png') ?>" alt=""
                                                     class="people animated boxHidden">
                                            </div>
                                            <span class='title'>Павел <br>Берлин</span>
                                            <p class='desc'>мастер спорта России <br>по пауэрлифтингу</p>
                                        </span>
                    </figure>
                    <figure class="item_el col-md-4 col-sm-4 col-xs-6">
                                        <span class='gran'>
                                            <div class='imit_img'>
                                                <img src="<?= Yii::getAlias('@web/img/man2.png') ?>" alt=""
                                                     class="people animated boxHidden delay-02s">
                                            </div>
                                            <span class='title'>Алексей <br>Пермяков</span>
                                            <p class='desc'>мастер спорта <br>по бодибилдингу</p>
                                        </span>
                    </figure>
                    <figure class="item_el col-md-4 col-sm-4 col-xs-6">
                                        <span class='gran'>
                                            <div class='imit_img'>
                                                <img src="<?= Yii::getAlias('@web/img/woman.png') ?>" alt=""
                                                     class="people animated boxHidden delay-06s" style="top: -125px;">
                                            </div>
                                            <span class='title'>Анна <br>Стрельцова</span>
                                            <p class='desc'>выступающая спортсменка <br>в номинации фитнес-бикини</p>
                                        </span>
                    </figure>
                </div>
            </div>
        </article>
    </div>
</div><!-- Контентная часть -->
*/?>