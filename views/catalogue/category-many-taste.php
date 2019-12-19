<?php
use app\models\Content;
use yii\helpers\Html;
use yii\helpers\Url;
use app\helpers\Image;
/**
 * @var $category \app\models\Category
 * @var $menu \app\models\Category[]
 * @var $this \yii\web\View
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
            <?php
            /**
             * @var $item \app\models\Product
             */
            foreach ($category->products as $item) { ?>
            <figure class="product group manyTaste">
                <div class="col-lg-4 col-md-4 col-xs-4 col-xxs-12 product-images">
                    <div>
                        <a href="<?=$item->url?>">
                            <?=$this->render('inc/item-first-image', ['item' => $item, 'width' => 270, 'height' => 291]) ?>
                        </a>
                    </div>
                </div>
                <figcaption class='col-lg-5 col-md-8 col-xs-8 col-xxs-12'>
                    <h3><a href='<?=$item->url?>'><?=$item->name?></a></h3>
                    <div class="hidden-lg bsWrap clearfix">
                        <?=$this->render('inc/store-buttons', ['item' => $item]) ?>
                    </div>
                    <?php /*
                    <div class="buttonSector">
                        <div class="button_link--default">
                            <?php if ($item->available) { ?>
                                <a id="<?=$item->id;?>" href="#modal" class="button_link buy" data-addToCart="">
                                    <span>добавить в корзину</span>
                                </a>
                            <?php } else { ?>
                                <span>временно нет в наличии</span>
                            <?php } ?>
                        </div>
                    </div>
                    */ ?>
                    <div class="desc_section">
                        <?php for ($i=0; $i < 4; $i++) {?>
                            <figure class="row clearfix">
                                <div class="img_section col-sm-3 col-xs-3">
                                    <img src="<?=Yii::getAlias('@web') . $item->portions[$i]->flavor->image?>" alt="<?=$item->name?>">
                                </div>
                                <figcaption class="col-sm-9 col-xs-9">
                                    <h5><a href='<?=$item->url?>#<?=$item->portions[$i]->flavor->hash?>'><?=$item->portions[$i]->flavor->name?></a></h5>
                                    <div>
                                        <span>в порции <?=$item->portions[$i]->portion_weight?> г.</span> <?=$item->portions[$i]->energy?> ккал
                                    </div>
                                    <div>
                                        <span>на 100 г.</span> <?=$item->portions[$i]->energy_per_100?> ккал
                                    </div>
                                </figcaption>
                            </figure>
                        <?php } ?>
                    </div>
                </figcaption>
                <div class='col-md-3 visible-lg'>
                    <?=$this->render('inc/store-buttons', ['item' => $item]) ?>
                </div>
            </figure>
            <?php } ?>
            <!-- Продукция END -->
            <div class="changeContentLine">
                <p>
                    <?php echo Content::text(
                        'catalogue.category.' .  ($category->slug ?  $category->slug : ('id-' . $category->id)), ''
                    ); ?>
                </p>
            </div>
        </article>
    </div>
</div><!-- Боковая навигация и контентная часть END -->