    <?php
use \yii\helpers\Url;
use app\models\Address;

/**
 * @var $this \yii\web\View
 */
use yii\helpers\Html;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="ru">
    <head><?=$this->render('/layouts/inc/head')?></head>
<body>
<?php $this->beginBody() ?>
<?php
$current_page = isset(Yii::$app->params['current_page']) ? Yii::$app->params['current_page'] : null;
?>
<?= $this->blocks['header'] ?>
<div class='container<?= ($current_page == "cart" ? " page_cart" : "") ?>'>
    <?= ($current_page == "cart" ? "
	<div class='footer_down'>
		<div class='footer_down-wrap'>
" : "") ?>
    <header class="header"><!-- Шапка сайта -->
        <div class="container_on-nav"><!-- Основная навигация -->
            <div class='position_nav'>
                <div class="wrapSection">
                    <div class='wrapper'>
                        <button type="button" class='fa fa-bars'></button>
                        <?php
                        $cartCount = (new \app\components\Card())->getItemsCount();
                        if ($cartCount > 999) {
                            $cartCount = '999+';
                        }
                        ?>
                        <nav class='nav'>
                            <a href="<?= Url::toRoute(['site/index']) ?>"
                               class='first <?php if (empty($current_page) || $current_page == 'index') {
                                   echo "active";
                               } ?>'><span><i class="fa fa-home"></i></span></a>
                            <a href="<?= Url::toRoute('catalogue/index') ?>"
                               class="<?php if ($current_page == 'catalogue') {
                                   echo "active";
                               } ?>"><span>Каталог</span></a>
                            <a href="<?= Url::toRoute(['site/page', 'view' => 'wherebuy']) ?>"
                               class="where_buy <?php if ($current_page == 'wherebuy') {
                                echo "active";
                            } ?>"><span>Где купить</span></a>
                            <a href="<?= Url::toRoute(['/news']) ?>"
                               class="<?php if ($current_page == 'news') {
                                   echo "active";
                               } ?>"><span>Новости</span></a>
                            <?php /*
                            <a href="<?= Url::toRoute(['site/page', 'view' => 'delivery']) ?>"
                               class="<?php if ($current_page == 'delivery') {
                                   echo "active";
                               } ?>"><span>Доставка</span></a>
                            */ ?>
                            <a href="<?= Url::toRoute(['site/page', 'view' => 'contacts']) ?>"
                               class='<?php if ($current_page == 'contacts') {
                                   echo "active";
                               } ?>'><span>Контакты</span></a>
                            <a href="/card"
                               class='last<?= ($current_page == 'cart' ? " active" : "") ?><?= ($cartCount > 0 ? ' notEmpty' : '') ?>'><span><i
                                        class="fa fa-shopping-cart"></i><span class="countTov"><i
                                            class="js-count"><?= $cartCount ?></i></span></span></a>
                        </nav>
                        <a href='#' class='editor fa fa-pencil-square-o'></a>
                    </div>
                    <a href="<?= Url::toRoute(['site/page', 'view' => 'card']) ?>" class='cartToMobile'><span><i
                                class="fa fa-shopping-cart"></i><span class="countTov"><i
                                    class="js-count"><?= $cartCount ?></i></span></span></a>
                </div>
                <div class="card">

                </div>
                <?php /*
				<!-- noindex -->
				<aside class="cartModal">
					<i class="fa fa-times close"></i>
					<div class="topPanel">
						<h3>Корзина</h3>
						<div class="price"><span>13</span> товаров на сумму <span>15 644 р.</span></div>
					</div>
					<table>
						<thead>
						<tr>
							<th>Название</th>
							<th>цена</th>
							<th>количество</th>
							<th>сумма</th>
							<th>&nbsp;</th>
						</tr>
						</thead>
						<tbody>
						<tr>
							<td class="name-product bold">AAKG 2:1 PINEAPPLE FRESH</td>
							<td><span>648</span> р.</td>
							<td>
								<div class="quantity">
									<i class="fa fa-minus minus js-minus"></i>
									<input type="text" value="1">
									<i class="fa fa-plus plus js-plus"></i>
								</div>
							</td>
							<td class="bold"><span>648</span> р.</td>
							<td><i class="fa fa-trash js-del del"></i></td>
						</tr>
						<tr>
							<td class="name-product bold">WHEY COMBO№1<span>MILK CHOCOLATE, BANANA YOGURT,  WILD CHERRY, YOGURT</span></td>
							<td><span>1 370</span> р.</td>
							<td>
								<div class="quantity">
									<i class="fa fa-minus minus js-minus"></i>
									<input type="text" value="1">
									<i class="fa fa-plus plus js-plus"></i>
								</div>
							</td>
							<td class="bold"><span>13 700</span> р.</td>
							<td><i class="fa fa-trash js-del del"></i></td>
						</tr>
						<tr>
							<td class="name-product bold">AAKG 2:1 PINEAPPLE FRESH</td>
							<td><span>648</span> р.</td>
							<td>
								<div class="quantity">
									<i class="fa fa-minus minus js-minus"></i>
									<input type="text" value="1">
									<i class="fa fa-plus plus js-plus"></i>
								</div>
							</td>
							<td class="bold"><span>648</span> р.</td>
							<td><i class="fa fa-trash js-del del"></i></td>
						</tr>
						<tr>
							<td class="name-product bold">AAKG 2:1 PINEAPPLE FRESH</td>
							<td><span>648</span> р.</td>
							<td>
								<div class="quantity">
									<i class="fa fa-minus minus js-minus"></i>
									<input type="text" value="1">
									<i class="fa fa-plus plus js-plus"></i>
								</div>
							</td>
							<td class="bold"><span>648</span> р.</td>
							<td><i class="fa fa-trash js-del del"></i></td>
						</tr>
						</tbody>
					</table>
					<div class="bottomPanel">
						<div class="button_link--default">
							<a href="<?= Url::toRoute(['site/page', 'view' => 'cart']) ?>" class="button_link"><span>перейти в корзину</span></a>
						</div>
						<span class="continue">продолжить покупки</span>
					</div>
				</aside>
				<!-- /noindex -->
                */ ?>
            </div>
        </div><!-- Основная навигация END -->
        <aside class="about_block<?= (empty($current_page) || $current_page == 'index' ? " page_cart-onMain" : "") ?>"><!-- Блок о нас -->
            <div class='wrapper'>
                <div class="group">
                    <div class="logo col-sm-3 col-xs-3 col-xxs-12">
                        <a href="<?= Url::toRoute('site/index') ?>">
                            <img src="<?= Yii::getAlias('@web/img/logo.png') ?>" alt="Логотип Primecraft">
                        </a>
                    </div>
                    <article class="about_block--text col-sm-9 col-xs-9 col-xxs-12">
                        <h2><?= \app\models\Content::text('slogan') ?></h2>
                        <div class="group">
                            <div class="col-md-4 col-sm-5 col-xs-12">
                                <div class="button_link--default">
                                    <a href="<?= Url::toRoute(['site/page', 'view' => 'about']) ?>" class='button_link'><span>Подробнее о нас</span><i></i></a>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </aside><!-- Блок о нас END -->
    </header><!-- Шапка сайта END -->
    <main class="main<?= (empty($current_page) || $current_page == 'index' ? " main-onMain" : "") ?>"><!-- Основная часть сайта -->
        <?= $content ?>
    </main><!-- Основная часть сайта END -->
    <?php if ($current_page != 'cart') { ?>
        <div class="colorBlock map"><!-- Карта -->
            <div class='wrapper'>
                <div class='group'>
                    <div class="lefter col-sm-3 col-xs-12">
                        <span>Где купить?</span>
                    </div>
                    <div class="righter col-sm-9 col-xs-12">
                        <!-- noindex -->
                        <div class="group" id="map_controls" data-url="<?= Url::toRoute('content/city-objects') ?>">
                            <div class="map_select col-sm-4 col-xs-4 col-xxs-12">
                                <select name="city">
                                    <option value="-1">Выберите город</option>
                                </select>
                            </div>
                            <div class="map_select col-sm-4 col-xs-4 col-xxs-12">
                                <select name="metro" style="display: none;">
                                    <option value="Станция метро">Станция метро</option>
                                </select>
                            </div>
                            <div class="map_or col-sm-1 col-xs-1 col-xxs-12" style="display: none;">или</div>
                            <div class="map_select col-sm-3 last col-xs-3 col-xxs-12">
                                <select name="area" style="display: none;">
                                    <option value="Район">Район</option>
                                </select>
                            </div>
                        </div>
                        <!-- /noindex -->
                    </div>
                </div>
            </div>
        </div><!-- Карта END -->
        <div class="google_map">
            <aside class="addr_on_map active">
                <div class="objects active">Магазины (<span id="objects_count"></span>)<i
                        class="fa fa-angle-double-down"></i>
                </div>
                <div class='objects_block-wrap'>
                    <div class="objects_block" id="objects_block">
                        <figure style="display: none" id="shop-tpl">
                            <h5 class="object_title"></h5>
                            <figcaption>
                                <span class='object_desc'></span>
                                <span class='object_addr'><span></span></span>
                                <a href='' class='object_tel'></a>
                                <a href='#' target='_blank' class='object_site'></a>
                            </figcaption>
                        </figure>
                    </div>
                </div>
            </aside>
            <div id='map' data-url="<?= Url::toRoute('content/addresses') ?>"></div>
        </div>
    <?php } ?>
    <?= ($current_page == "cart" ? "
		</div>
		</div>
" : "") ?>
    <footer class='colorBlock footer'><!-- Подвал сайта -->
        <div class='wrapper'>
            <div class="lefter col-sm-9 col-xs-8">
                <div class="footer_addr">
                    <div class="group">
                        <div class="addr col-md-6 col-sm-7">
                            <h5>наш офис</h5>
                            <img src="<?= Yii::getAlias('@web/img/office.png') ?>" alt="">
                            <p><?= Address::getOffice()->description ?><br>
                                <span class="js-office" data-latitude="<?= Address::getOffice()->latitude ?>"
                                      data-longitude="<?= Address::getOffice()->longitude ?>"><?= Address::getOffice()->address ?></span>
                            </p>
                        </div>
                        <div class="tel_mail col-md-6 col-sm-5">
                            <nav class="footerNav">
                                <a href="<?= Url::toRoute(['site/page', 'view' => 'about']) ?>"
                                   class="<?php if ($current_page == 'about') {
                                       echo "active";
                                   } ?>">О нас</a>
                                <a href="<?= Url::toRoute('news/index') ?>" class="<?php if ($current_page == 'news') {
                                    echo "active";
                                } ?>">Новости</a>
                                <a href="<?= Url::toRoute(['/article/index']) ?>" class="<?=($current_page == 'articles' ? 'class="active"' : '')?>">Статьи</a><br>
                                <a href="<?= Url::toRoute(['site/page', 'view' => 'contacts']) ?>"
                                   class="<?php if ($current_page == 'contacts') {
                                       echo "active";
                                   } ?>">Контакты</a>
                                <a href="<?= Url::toRoute(['site/sitemap']) ?>">Карта сайта</a>
                            </nav>
                            <a href='tel:<?= Address::getOffice()->getPhoneNumber() ?>'
                               class='contact_tel'><?= Address::getOffice()->phones ?></a>
                            <a href='mailto:<?= Address::getOffice()->email ?>'
                               class='contact_email'><?= Address::getOffice()->email ?></a>
                            <a href="mailto:info@primekraft.ru" class="contact_email">info@primekraft.ru</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="righter col-sm-3 col-xs-4">
                <div class="soc_icons"><!-- noindex -->
                    <!--                    <i><a href="#" target='_blank' class="fa fa-twitter" rel="nofollow"></a></i>-->
                    <i><a href="https://www.instagram.com/prime_kraft/" target='_blank' class="fa fa-instagram"
                          rel="nofollow"></a></i>
                    <i><a href="https://vk.com/primekraft" target='_blank' class="fa fa-vk" rel="nofollow"></a></i>
                    <i><a href="https://www.facebook.com/primekraftru/" target='_blank' class="fa fa-facebook"
                          rel="nofollow"></a></i>
                </div><!-- /noindex -->
                <div class="button_link--footer">
                    <a href="#modal" class='button_link modal'
                       data-ya-target="write-to-us"><span>Напишите нам</span></a>
                </div>
            </div>
        </div>
    </footer><!-- Подвал сайта END -->
    <!-- noindex -->
    <div class="success-block">
        <h4>Сообщение отправлено!</h4>
        <div>Скоро наши специалисты свяжутся с Вами.</div>
    </div>
    <div class="error-block">
        <h4>Неудачная отправка!</h4>
        <div>Отправка не удалась по техническим причинам, попробуйте еще раз.</div>
    </div>
    <div class='popup mfp-hide' id='modal'>
        <?= $this->renderFile('@app/views/layouts/inc/feedback_form.php', ['css_class' => 'modal_Form']) ?>
    </div>
    <div class='popup mfp-hide' id='modal-distr'>
        <?= $this->renderFile('@app/views/layouts/inc/feedback_form-distr.php', ['css_class' => 'modal_Form']) ?>
    </div>
    <!-- /noindex -->
</div>
<!-- noindex -->
<div class="fixed_soc_icons">
    <div class="soc_icons top"><!-- noindex -->
        <?php /*
            <i><a href="#" target='_blank' class="fa fa-twitter" rel="nofollow"></a></i>-->
        */ ?>
        <i><a href="https://www.youtube.com/channel/UCOh5M9_jPtm8iLOfpnOWJbg" target='_blank' class="fa fa-youtube" rel="nofollow"></a></i>
        <i><a href="https://www.instagram.com/prime_kraft/" target='_blank' class="fa fa-instagram" rel="nofollow"></a></i>
        <i><a href="https://vk.com/primekraft" target='_blank' class="fa fa-vk" rel="nofollow"></a></i>
        <i><a href="https://www.facebook.com/primekraftru/" target='_blank' class="fa fa-facebook"
              rel="nofollow"></a></i>
    </div><!-- /noindex -->
</div>
<!-- /noindex -->
<script src='<?= Yii::getAlias('@web/js/main.js?unchache=2') ?>'></script>
<script src='<?= Yii::getAlias('@web/js/ajax-form.js?unchache=1') ?>'></script>
<?php if (YII_ENV == 'prod') { ?>
    <!-- Facebook Pixel Code -->
    <script>
        !function (f, b, e, v, n, t, s) {
            if (f.fbq)return;
            n = f.fbq = function () {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq)f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window,
            document, 'script', 'https://connect.facebook.net/en_US/fbevents.js');

        fbq('init', '1590156464611944');
        fbq('track', "PageView");</script>
    <noscript><img height="1" width="1" style="display:none"
                   src="https://www.facebook.com/tr?id=1590156464611944&ev=PageView&noscript=1"
        /></noscript>
    <!-- End Facebook Pixel Code -->
    <script
    <script type="text/javascript">(window.Image ? (new Image()) : document.createElement('img')).src = location.protocol + '//vk.com/rtrg?r=XsV0fCpFXoadtIiPCgtWJOep5LxK7qQKyLHEBnT..*UrUgob3ynDNw5mthsTY80CIn737rjI-&pixel_id=1000075410';</script>

    <!-- VK Chat ---->
    <script type="text/javascript" src="//vk.com/js/api/openapi.js?129"></script>
    <!-- VK Widget -->
    <div id="vk_community_messages"></div>
    <script type="text/javascript">
        VK.Widgets.CommunityMessages("vk_community_messages", 119258690, {});
    </script>
    <!-- /VK Chat ---->
    <!-- VK Pixel Code -->
    <script type="text/javascript">(window.Image ? (new Image()) : document.createElement('img')).src = 'https://vk.com/rtrg?p=VK-RTRG-75410-281fp';</script>
    <!-- /VK Pixel Code -->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-59067127-31"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'UA-59067127-31');
    setTimeout("gtag('event', 'read')",15000);
    </script>
    <!-- /Global site tag (gtag.js) - Google Analytics -->
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" >
        (function (d, w, c) {
            (w[c] = w[c] || []).push(function() {
                try {
                    w.yaCounter36601960 = new Ya.Metrika2({
                        id:36601960,
                        clickmap:true,
                        trackLinks:true,
                        accurateTrackBounce:true,
                        webvisor:true
                    });
                } catch(e) { }
            });
            var n = d.getElementsByTagName("script")[0],
                s = d.createElement("script"),
                f = function () { n.parentNode.insertBefore(s, n); };
            s.type = "text/javascript";
            s.async = true;
            s.src = "https://mc.yandex.ru/metrika/tag.js";
            if (w.opera == "[object Opera]") {
                d.addEventListener("DOMContentLoaded", f, false);
            } else { f(); }
        })(document, window, "yandex_metrika_callbacks2");
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/36601960" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->
<?php } ?>
<?= \app\helpers\Admin::js() ?>
<?php $this->endBody() ?>
<script src="//api.storverk.ru/aggregator.js?id=75"></script>
</body>
</html>
<?php $this->endPage() ?>