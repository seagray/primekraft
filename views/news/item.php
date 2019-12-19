<?php
use app\helpers\SeoOut;
use yii\helpers\Url;

/**
 * @var $news \app\models\News
 */
?>
<div class='wrapper'><!-- Боковая навигация и контентная часть -->
    <div class="group">
        <!-- Боковая навигация -->
        <aside class="sidebar col-sm-3">
            <!-- Breadcrumbs -->
            <aside class="breadcrumbs">
                                <span>
                                    <a href="<?=Url::toRoute(['site/index'])?>">Главная</a>
                                </span>
                                <span>
                                    <a href="<?=Url::toRoute(['news/index'])?>">Новости</a>
                                </span>
            </aside>
            <!-- Breadcrumbs END -->
        </aside><!-- Боковая навигация END -->
        <article class="content"><!-- Контент -->
            <h2><?=$news->title?></h2>
        </article><!-- Контент END -->
        <article class="content"><!-- Контент -->
            <div class="group full_news">
                <div class="col-sm-3 col-xs-12 lefter">
                    <div class="date">
                        <?=$news->date()?>
                    </div>
                    <?=SeoOut::img(Yii::getAlias('@web') . $news->image, [
                        'alt' => $news->title,
                        'title' => $news->title,
                        'class' => 'news_img'
                    ], 600, 400)?>
                </div>
                <div class="col-sm-9 col-xs-12 righter">
                    <div class="news_text">
                        <?=SeoOut::img(Yii::getAlias('@web') . $news->image, [
                            'alt' => $news->title,
                            'title' => $news->title,
                            'class' => 'news_img-onMobile'
                        ], 305, 305)?>
                        <?=$news->text?>
                    </div>
                    <a href="<?=Url::toRoute('news/index')?>" class='news_list'>К списку новостей</a>
                </div>
            </div>
        </article><!-- Контент END -->
    </div>
</div>