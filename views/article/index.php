<?php
use app\helpers\SeoOut;
use yii\helpers\Url;
/**
 * @var $list \app\models\Article[]
 */
?>
<div class='wrapper'><!-- Боковая навигация и контентная часть -->
    <div class="group">
        <article class="content"><!-- Контент -->
            <div class="news">
                <?php if (isset($this->context->h1) && !empty($this->context->h1)) { ?>
                    <h1><?=\yii\helpers\Html::encode($this->context->h1)?></h1>
                <?php } else { ?>
                    <h1>Статьи</h1>
                <?php } ?>
                <div class='group'>
                    <?php if (!empty($list)) { ?>
                        <?php foreach ($list as $article) { ?>
                            <figure class="item_el col-sm-4 col-xs-6">
                                <div class="el_news animated boxHidden">
                                    <a href="<?=Url::to(['/article/item', 'url' => $article->url])?>">
                                        <?=SeoOut::img($article->image, [
                                            'alt' => $article->title,
                                            'title' => $article->title
                                        ], 334, 223)?>
                                    </a>
                                    <span class='title'><?=$article->title?></span>
                                    <p class='desc'><?=$article->announce?>
                                        <?php if ($article->text){?><a href="<?=Url::to(['/article/item', 'url' => $article->url])?>">...</a><?php } ?>
                                    </p>
                                    <span class='date'><?=$article->date?></span>
                                </div>
                            </figure>
                        <?php } ?>
                    <?php } else { ?>
                        <figure class="item_el col-sm-4 col-xs-6" style="width: 100%; text-align: center;">
                            Пока нет статей на сайте.
                        </figure>
                    <?php } ?>
                </div>
            </div>
        </article>
    </div>
</div>