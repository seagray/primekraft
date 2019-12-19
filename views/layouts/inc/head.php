<?php
    use yii\helpers\Html;
?>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="google-site-verification" content="mmMScM0ixN2hq6RrB8hx7zPa3E0y-Q-xFcRZWMgaqGg"/>
<meta name="yandex-verification" content="5d87ea629d4224fa"/>
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
<?= Html::csrfMetaTags() ?>

<?php $this->head(); ?>

<?php if (!empty($this->title)) { ?>
    <title><?=Html::encode($this->title)?></title>
<?php } ?>

<?php
if (YII_ENV == 'prod') {
    $url_now = $_SERVER['REQUEST_URI'];

    $cat_list = substr_count($url_now, 'production/category');
    $product_one = substr_count($url_now, 'production/item');

    if ($mysqli = new mysqli('localhost', 'a0026999', 'vikuficize', 'a0026999_fb')) {
        $mysqli->query("SET NAMES utf8");
    } else {
        die('Ошибка подключения к базе данных');
    }

    if ($cat_list > 0) {
        $id_cat = explode("production/category", $url_now);
        $id_cat = (int)$id_cat[1];
        $sql_cat = $mysqli->query("SELECT * FROM `category` WHERE `id`=$id_cat");
        $res_cat = $sql_cat->fetch_array();
        $title = "Prime Kraft " . $res_cat['name'];
        $keywords = $res_cat['name'];
        $desc = "Продукты " . $res_cat['name'] . " Prime Kraft";
    }

    if ($product_one > 0) {
        $id_prod = explode("production/item", $url_now);
        $id_prod = (int)$id_prod[1];
        $sql_prod = $mysqli->query("SELECT * FROM `product` WHERE `id`=$id_prod");
        $res_prod = $sql_prod->fetch_array();

        $id_cat = (int)$res_prod['category_id'];
        $sql_cat = $mysqli->query("SELECT * FROM `category` WHERE `id`=$id_cat");
        $res_cat = $sql_cat->fetch_array();
        if ($res_cat['type'] == 1) {
            $dop_name = "";
        } else {
            $dop_name = $res_cat['name'] . " ";
        }

        $title = "Prime Kraft " . $dop_name . $res_prod['name'] . " цена";
        $keywords = $dop_name . $res_prod['name'];
        $desc = "Описание, пищевая ценность, где купить, как принимать";
    }

    $mysqli->close();

    ?>

    <?php /*

    <?php if ($url_now == '/production') { ?>
        <meta name='keywords' content='Каталог PrimeKraft, продукция prime kraft'>
        <meta name='description' content='Широкая линейка продукции прайм крафт.'>
    <?php } ?>

    <?php if ($url_now == '/') { ?>
        <meta name='keywords' content='PrimeKraft, прайм крафт, prime kraft'>
        <meta name='description'
              content='Компания Прайм Крафт занимается разработкой и производством спортивного питания.'>
    <?php } ?>

    <?php if ($url_now == '/news') { ?>
        <meta name='keywords' content='новости прайм крафт, новости primekraft'>
        <meta name='description' content='Последние новости в фирме Прайм Крафт'>
    <?php } ?>

    <?php if ($url_now == '/about') { ?>
        <meta name='keywords' content='о компании прайм крафт'>
        <meta name='description' content='PrimeKraft - сила в качестве. Бренд спортивного питания.'>
    <?php } ?>

    <?php if ($url_now == '/contacts') { ?>
        <meta name='keywords' content='контакты'>
        <meta name='description' content='Хотите стать нашим дистрибьютером? напишите нам.'>
    <?php } ?>


    <?php if ($cat_list > 0 or $product_one > 0) { ?>
        <meta name='keywords' content='<?= $keywords ?>'>
        <meta name='description' content='<?= $desc ?>'>
    <?php } ?>

    */ ?>

    <?php if (empty($this->title)) { ?>
        <?php if ($url_now == '/production') { ?>
            <title>Каталог продукции PrimeKraft :: Прайм Крафт</title>
        <?php } ?>

        <?php if ($url_now == '/') { ?>
            <title>PrimeKraft - производство спортивного питания :: Прайм Крафт</title>
        <?php } ?>

        <?php if ($url_now == '/news') { ?>
            <title>Новости в Prime Kraft :: Прайм Крафт</title>
        <?php } ?>

        <?php if ($url_now == '/about') { ?>
            <title>О компании Prime Kraft :: Прайм Крафт</title>
        <?php } ?>

        <?php if ($url_now == '/cart') { ?>
            <title>Корзина Prime Kraft :: Прайм Крафт</title>
        <?php } ?>

        <?php if ($url_now == '/contacts') { ?>
            <title>Контакты Prime Kraft :: Прайм Крафт</title>
        <?php } ?>

        <?php if ($cat_list > 0 or $product_one > 0) { ?>
            <title><?= $title ?></title>
        <?php } ?>
    <?php } ?>
<?php } ?>
<link rel="apple-touch-icon" href="<?= Yii::getAlias('@web/favicon/apple-icon.png.png') ?>">
<link rel="apple-touch-icon" sizes="57x57" href="<?= Yii::getAlias('@web/favicon/apple-icon-57x57.png') ?>">
<link rel="apple-touch-icon" sizes="60x60" href="<?= Yii::getAlias('@web/favicon/apple-icon-60x60.png') ?>">
<link rel="apple-touch-icon" sizes="72x72" href="<?= Yii::getAlias('@web/favicon/apple-icon-72x72.png') ?>">
<link rel="apple-touch-icon" sizes="76x76" href="<?= Yii::getAlias('@web/favicon/apple-icon-76x76.png') ?>">
<link rel="apple-touch-icon" sizes="114x114" href="<?= Yii::getAlias('@web/favicon/apple-icon-114x114.png') ?>">
<link rel="apple-touch-icon" sizes="120x120" href="<?= Yii::getAlias('@web/favicon/apple-icon-120x120.png') ?>">
<link rel="apple-touch-icon" sizes="144x144" href="<?= Yii::getAlias('@web/favicon/apple-icon-144x144.png') ?>">
<link rel="apple-touch-icon" sizes="152x152" href="<?= Yii::getAlias('@web/favicon/apple-icon-152x152.png') ?>">
<link rel="apple-touch-icon" sizes="180x180" href="<?= Yii::getAlias('@web/favicon/apple-icon-180x180.png') ?>">
<link rel="apple-touch-icon" href="<?= Yii::getAlias('@web/favicon/apple-icon-precomposed.png') ?>">

<link rel="icon" type="image/png" sizes="36x36" href="<?= Yii::getAlias('@web/favicon/android-icon-36x36.png') ?>">
<link rel="icon" type="image/png" sizes="48x48" href="<?= Yii::getAlias('@web/favicon/android-icon-48x48.png') ?>">
<link rel="icon" type="image/png" sizes="72x72" href="<?= Yii::getAlias('@web/favicon/android-icon-72x72.png') ?>">
<link rel="icon" type="image/png" sizes="96x96" href="<?= Yii::getAlias('@web/favicon/android-icon-96x96.png') ?>">
<link rel="icon" type="image/png" sizes="144x144"
      href="<?= Yii::getAlias('@web/favicon/android-icon-144x144.png') ?>">
<link rel="icon" type="image/png" sizes="192x192"
      href="<?= Yii::getAlias('@web/favicon/android-icon-192x192.png') ?>">

<link rel="icon" type="image/png" sizes="32x32" href="<?= Yii::getAlias('@web/favicon/favicon-32x32.png') ?>">
<link rel="icon" type="image/png" sizes="96x96" href="<?= Yii::getAlias('@web/favicon/favicon-96x96.png') ?>">
<link rel="icon" type="image/png" sizes="16x16" href="<?= Yii::getAlias('@web/favicon/favicon-16x16.png') ?>">

<link rel="manifest" href="<?= Yii::getAlias('@web/favicon/manifest.json') ?>">
<meta name="msapplication-TileColor" content="#ffffff">

<meta name="msapplication-TileImage" content="<?= Yii::getAlias('@web/favicon/ms-icon-70x70.png') ?>">
<meta name="msapplication-TileImage" content="<?= Yii::getAlias('@web/favicon/ms-icon-144x144.png') ?>">
<meta name="msapplication-TileImage" content="<?= Yii::getAlias('@web/favicon/ms-icon-150x150.png') ?>">
<meta name="msapplication-TileImage" content="<?= Yii::getAlias('@web/favicon/ms-icon-310x310.png') ?>">

<meta name="theme-color" content="#ffffff">

<link rel='icon' href='<?= Yii::getAlias('@web/favicon.ico') ?>' type='image/x-icon'>
<link rel='shortcut icon' href="<?= Yii::getAlias('@web/favicon.ico') ?>" type='image/x-icon'>
<link href="<?= Yii::getAlias('@web/favicon_apple.png') ?>" rel='apple-touch-icon' type='image/png'>


<!-- -->
<link rel='stylesheet' href='<?= Yii::getAlias('@web/css/animate.css') ?>'>
<link rel='stylesheet' href='<?= Yii::getAlias('@web/css/datepicker.min.css') ?>'>
<link rel='stylesheet' href='<?= Yii::getAlias('@web/css/font-awesome.css') ?>'>
<link rel='stylesheet' href='<?= Yii::getAlias('@web/css/slick.css') ?>'>
<!-- -->

<link rel='stylesheet' href='<?= Yii::getAlias('@web/css/style.css') ?>?12'>

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<!--[if lt IE 9]>
<script src="//oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="//oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<script src='<?= Yii::getAlias('@web/js/jquery.min.js') ?>'></script>
<script src="<?= Yii::getAlias('@web/js/waypoints.js') ?>"></script>
<script
    src='//maps.googleapis.com/maps/api/js?key=AIzaSyDSesk9ODyoQR0zwXbAN-WodHlVPSLJxJE&sensor=false&extension=.js'></script>
<script src="<?= Yii::getAlias('@web/js/jquery.fancybox.pack.js') ?>"></script>
<script src="<?= Yii::getAlias('@web/js/validate.js') ?>"></script>
<script src="<?= Yii::getAlias('@web/js/masonry.js') ?>"></script>
<script src="<?= Yii::getAlias('@web/js/plupload.full.min.js') ?>"></script>
<script src="<?= Yii::getAlias('@web/js/magnif.js') ?>"></script>
<script src="<?= Yii::getAlias('@web/js/mask.js') ?>"></script>
<script src="<?= Yii::getAlias('@web/js/datepicker.min.js') ?>"></script>
<script src="<?= Yii::getAlias('@web/js/slick.min.js') ?>"></script>
<script src="<?= Yii::getAlias('@web/js/card.js?unchache=1') ?>"></script>
<script src="<?= Yii::getAlias('@web/js/jquery.sticky.js') ?>"></script>


<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function () {
            try {
                w.yaGoal = w.yaCounter36601960 = new Ya.Metrika({
                    id: 36601960,
                    clickmap: true,
                    trackLinks: true,
                    accurateTrackBounce: true,
                    webvisor: true
                });
            } catch (e) {
            }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () {
                n.parentNode.insertBefore(s, n);
            };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else {
            f();
        }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript>
    <div><img src="https://mc.yandex.ru/watch/36601960" style="position:absolute; left:-9999px;" alt=""/></div>
</noscript>
<!-- /Yandex.Metrika counter -->
