<?php
use app\models\Content;
use yii\helpers\Html;
use yii\helpers\Url;
use app\helpers\Image;
/**
 * @var $category \app\models\Category
 * @var $menu \app\models\Category[]
 */
?>
<div class='wrapper'><!-- Боковая навигация и контентная часть -->
    <div class="group">
        <!-- Боковая навигация -->
        <aside class="sidebar col-sm-3">
            <!-- Breadcrumbs -->
            <aside class="breadcrumbs">
                            <span>
                                <a href="<?=Url::toRoute('site/index')?>">Главная</a>
                            </span>
                            <span>
                                <a href="<?=Url::toRoute('catalogue/index')?>">Каталог</a>
                            </span>
            </aside>
            <!-- Breadcrumbs END -->
            <h3>Продукция</h3>
            <?=$this->render('inc/menu', ['menu' => $menu, 'current_category_id' => $category->id]) ?>
        </aside><!-- Боковая навигация END -->
        <article class="content"><!-- Контент -->
            <?php if (isset($this->context->h1) && !empty($this->context->h1)) { ?>
                <h1><?=Html::encode($this->context->h1)?></h1>
            <?php } else { ?>
                <h1><?=Html::encode($category->name)?></h1>
            <?php } ?>
            <!-- Продукция -->
            <div class='group'>
                <?php foreach ($category->products as $item) { ?>
                    <figure class="product_bank clearfix">
                        <a href="<?=$item->url?>" class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-xxs-12">
                            <?=$this->render('inc/item-first-image', ['item' => $item, 'width' => 270, 'height' => 284]) ?>
                        </a>
                        <figcaption class="col-lg-6 col-md-8 col-sm-8 col-xs-8 col-xxs-12">
                            <h4><a href="<?=$item->url?>"><?=$item->name?></a></h4>
                            <div class="hidden-lg bsWrap clearfix">
                                <?=$this->render('inc/store-buttons', ['item' => $item]) ?>
                            </div>
<!--                            <div>Энергетическая ценность</div>-->
                            <p><span>в порции <?=$item->portion->portion_weight?> г.</span><span><?=$item->portion->energy?> ккал</span></p>
                            <p><span>на 100 г.</span><span><?=$item->portion->energy_per_100?> ккал</span></p>

                        </figcaption>
                        <div class="col-lg-2 visible-lg">
                            <?=$this->render('inc/store-buttons', ['item' => $item]) ?>
                        </div>
                    </figure>
                <?php } ?>
            </div>
            <!-- Продукция END -->
            <div class="changeContentLine">
                <p>
                <?php echo Content::text(
                    'catalogue.category.' . ($category->slug ?  $category->slug : ('id-' . $category->id)), ''
                ); ?>
                </p>
            </div>
        </article>
    </div>
</div><!-- Боковая навигация и контентная часть END -->