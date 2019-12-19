<?php
use app\helpers\SeoOut;
use yii\helpers\Url;
/**
 * @var $list \app\models\News[]
 */
?>
<div class='wrapper'><!-- Боковая навигация и контентная часть -->
    <div class="group">
        <article class="content"><!-- Контент -->
            <div class="news">
                <?php if (isset($this->context->h1) && !empty($this->context->h1)) { ?>
                    <h1><?=\yii\helpers\Html::encode($this->context->h1)?></h1>
                <?php } else { ?>
                    <h1>Новости</h1>
                <?php } ?>
                <div class='group'>
                    <?php foreach ($list as $news) { ?>
                        <figure class="item_el col-sm-4 col-xs-6">
							<div class="el_news animated boxHidden">
								<a href="<?=Url::toRoute(['news/item', 'id' => $news->id])?>">
                                    <?=SeoOut::img($news->image, [
                                        'alt' => $news->title,
                                        'title' => $news->title
                                    ], 334, 223)?>
								</a>
								<span class='title'><?=$news->title?></span>
								<p class='desc'><?=$news->announce?><?php if ($news->text){?><a href="<?=Url::toRoute(['news/item', 'id' => $news->id])?>">...</a><?php } ?></p>
								<span class='date'><?=$news->date()?></span>
							</div>
                        </figure>
                    <?php } ?>
                </div>
            </div>
			<!-- aside class='pagination'>
				<ul>
					<li>
						<a href="#" class='active'>1</a>
					</li>
					<li>
						<a href="#">2</a>
					</li>
					<li>
						<a href="#">3</a>
					</li>
					<li>
						<a href="#">4</a>
					</li>
				</ul>
			</aside -->
        </article>
    </div>
</div>