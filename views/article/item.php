<?php

use app\helpers\SeoOut;
use yii\helpers\Url;

/**
 * @var \app\models\Article $article
 * @var \app\models\Article[] $recommends
 */
?>
<div class='wrapper'><!-- Боковая навигация и контентная часть -->
    <div class="group">
        <!-- Боковая навигация -->
        <aside class="sidebar col-sm-3">
            <!-- Breadcrumbs -->
            <aside class="breadcrumbs">
                <span>
                    <a href="<?=Url::to(['/site/index'])?>">Главная</a>
                </span>
                <span>
                    <a href="<?=Url::to(['/article/index'])?>">Статьи</a>
                </span>
            </aside>
            <!-- Breadcrumbs END -->
        </aside><!-- Боковая навигация END -->
        <article class="content"><!-- Контент -->
            <h1><?=$article->title?></h1>
        </article><!-- Контент END -->
        <article class="content"><!-- Контент -->
            <div class="group full_news">
                <div class="col-sm-3 col-xs-12 lefter">
                    <div class="date">
                        <?=$article->date?>
                    </div>
                    <div class="sharing swap-small">
                        <div>
                            <a href="https://vk.com/share.php?url=<?=Url::current([], true)?>" target="_blank" class="vk">
                                <i class="fa fa-vk" aria-hidden="true"></i><span></span>
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?=Url::current([], true)?>" target="_blank" class="fb">
                                <i class="fa fa-facebook" aria-hidden="true"></i><span></span>
                            </a>
                            <a href="https://twitter.com/share?url=<?=Url::current([], true)?>" target="_blank" class="tw">
                                <i class="fa fa-twitter" aria-hidden="true"></i>
                            </a>
                            <a href="https://connect.ok.ru/offer?url=<?=Url::current([], true)?>" target="_blank" class="ok">
                                <i class="fa fa-odnoklassniki" aria-hidden="true"></i><span></span>
                            </a>
                        </div>
                    </div>
                    <?=SeoOut::img(Yii::getAlias('@web') . $article->image, [
                        'alt' => $article->title,
                        'title' => $article->title,
                        'class' => 'news_img'
                    ], 600, 400)?>
                    <div class="article-nav" id="articleMenu">
                        <p>Содержание:</p>
                        <ul></ul>
                        <a href="<?=Url::to(['article/index'])?>" class='news_list'>К списку статей</a>
                    </div>
                </div>
                <div class="col-sm-9 col-xs-12 righter">
                    <div class="news_text">
                        <div class="sharing swap-large">
                            <div>
                                <a href="https://vk.com/share.php?url=<?=Url::current([], true)?>" target="_blank" class="vk">
                                    <i class="fa fa-vk" aria-hidden="true"></i><span></span>
                                </a>
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?=Url::current([], true)?>" target="_blank" class="fb">
                                    <i class="fa fa-facebook" aria-hidden="true"></i><span></span>
                                </a>
                                <a href="https://twitter.com/share?url=<?=Url::current([], true)?>&text=" target="_blank" class="tw">
                                    <i class="fa fa-twitter" aria-hidden="true"></i>
                                </a>
                                <a href="https://connect.ok.ru/offer?url=<?=Url::current([], true)?>" target="_blank" class="ok">
                                    <i class="fa fa-odnoklassniki" aria-hidden="true"></i><span></span>
                                </a>
                            </div>
                        </div>
                        <?=SeoOut::img(Yii::getAlias('@web') . $article->image, [
                            'alt' => $article->title,
                            'title' => $article->title,
                            'class' => 'news_img-onMobile'
                        ], 305, 305)?>
                        <?=$article->text?>
                        <div class="sharing">
                            <div>
                                <a href="https://vk.com/share.php?url=<?=Url::current([], true)?>" target="_blank" class="vk">
                                    <i class="fa fa-vk" aria-hidden="true"></i><span></span>
                                </a>
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?=Url::current([], true)?>" target="_blank" class="fb">
                                    <i class="fa fa-facebook" aria-hidden="true"></i><span></span>
                                </a>
                                <a href="https://twitter.com/share?url=<?=Url::current([], true)?>" target="_blank" class="tw">
                                    <i class="fa fa-twitter" aria-hidden="true"></i>
                                </a>
                                <a href="https://connect.ok.ru/offer?url=<?=Url::current([], true)?>" target="_blank" class="ok">
                                    <i class="fa fa-odnoklassniki" aria-hidden="true"></i><span></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if (!empty($recommends)) { ?>
            <div class="news readAlso">
                <h3>Читайте также</h3>
                <div class="group">
                    <?php foreach ($recommends as $recommend) { ?>
                        <figure class="item_el col-sm-4 col-xs-6">
                            <div class="el_news animated boxHidden">
                                <a href="<?=Url::to(['/article/item', 'url' => $recommend->url])?>">
                                    <?=SeoOut::img($recommend->image, [
                                        'alt' => $recommend->title,
                                        'title' => $recommend->title
                                    ], 334, 223)?>
                                </a>
                                <span class='title'><?=$recommend->title?></span>
                                <p class='desc'><?=$recommend->announce?>
                                    <?php if ($recommend->text){?><a href="<?=Url::to(['/article/item', 'url' => $recommend->url])?>">...</a><?php } ?>
                                </p>
                                <span class='date'><?=$recommend->date?></span>
                            </div>
                        </figure>
                    <?php } ?>
                </div>
            </div>
            <?php } ?>
        </article><!-- Контент END -->
    </div>
</div>