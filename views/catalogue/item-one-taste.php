<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\helpers\Image;
/**
 * @var $item \app\models\Product
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
                            <span>
                                <a href="<?=$item->category->url?>"><?=$item->category->name?></a>
                            </span>
            </aside>            <!-- Breadcrumbs END -->
            <h3>Продукция</h3>
            <?=$this->render('inc/menu', ['menu' => $menu, 'current_category_id' => $item->category->id, 'current_item_id' => $item->id]) ?>
        </aside><!-- Боковая навигация END -->
        <article class="content"><!-- Контент -->
            <?php if (isset($this->context->h1) && !empty($this->context->h1)) { ?>
                <h1><?=Html::encode($this->context->h1)?></h1>
            <?php } else { ?>
                <h1><?=Html::encode($item->category->name)?> <span><?=Html::encode($item->portion->flavor->name)?></span></h1>
            <?php } ?>

            <!-- Продукция -->
            <div class="product_full clearfix">
                <div class='product_full-desc group oneTaste'>
                    <div class="product_full--img col-lg-4 col-sm-4">
                        <?=$this->render('inc/item-images', ['item' => $item]) ?>
                        <?php
                        /*

                        <div class='miniatures_img group'>
                                        <span class='col-sm-4'>
                                            <img src="<?=Yii::getAlias('@web/img/miniatures_img.png')?>" data-src="<?=Yii::getAlias('@web/img/miniatures_img.png')?>" alt="">
                                        </span>
                                        <span class='col-sm-4'>
                                            <img src="<?=Yii::getAlias('@web/img/miniatures_img2.png')?>" data-src="<?=Yii::getAlias('@web/img/miniatures_img2.png')?>" alt="">
                                        </span>
                                        <span class='col-sm-4'>
                                            <img src="<?=Yii::getAlias('@web/img/miniatures_img3.png')?>" data-src="<?=Yii::getAlias('@web/img/miniatures_img3.png')?>" alt="">
                                        </span>
                        </div>
                        */
                        ?>
                    </div>
                    <div class='col-lg-5 col-sm-8'>
                        <div class="visible-xs">
                            <?=$this->render('inc/item-images-controls', ['item' => $item]) ?>
                        </div>
                        <div class="hidden-lg bsWrap clearfix">
                            <?=$this->render('inc/store-buttons', ['item' => $item]) ?>
                        </div>
                        <!-- noindex -->
                        <!--div class="soc_icons">
                            <i><a rel="nofollow" class="fa fa-twitter" target="_blank" href="#"></a></i>
                            <i><a rel="nofollow" class="fa fa-instagram" target="_blank" href="#"></a></i>
                            <i><a rel="nofollow" class="fa fa-vk" target="_blank" href="#"></a></i>
                            <i><a rel="nofollow" class="fa fa-facebook" target="_blank" href="#"></a></i>
                        </div-->
                        <!-- /noindex -->
                      <?php /* <p><b>Минимальная розничная цена : <span><?=$item->price?>р.</span></b></p> */ ?>
                        <p class="first-par">Вес упаковки : <b><?=$item->weight?> г.</b><br>
                            количество порций : <b><?=$item->portions_count?> порций</b><br>
                            Вес порции : <b><?=$item->portion->portion_weight?> г.</b></p>
                        <div class="hidden-xs">
                            <?=$this->render('inc/item-images-controls', ['item' => $item]) ?>
                        </div>
                    </div>
                    <div class="col-sm-3 visible-lg bsWrap">
                        <?=$this->render('inc/store-buttons', ['item' => $item]) ?>
                    </div>


                        <?php
                        /*

                        <div class='miniatures_img group'>
                                        <span class='col-sm-4'>
                                            <img src="<?=Yii::getAlias('@web/img/miniatures_img.png')?>" data-src="<?=Yii::getAlias('@web/img/miniatures_img.png')?>" alt="">
                                        </span>
                                        <span class='col-sm-4'>
                                            <img src="<?=Yii::getAlias('@web/img/miniatures_img2.png')?>" data-src="<?=Yii::getAlias('@web/img/miniatures_img2.png')?>" alt="">
                                        </span>
                                        <span class='col-sm-4'>
                                            <img src="<?=Yii::getAlias('@web/img/miniatures_img3.png')?>" data-src="<?=Yii::getAlias('@web/img/miniatures_img3.png')?>" alt="">
                                        </span>
                        </div>
                        */
                        ?>
                    </div>
                    <div class='col-lg-8 col-sm-9 paramTable'>
                        <!-- noindex -->
                        <!--div class="soc_icons">
                            <i><a rel="nofollow" class="fa fa-twitter" target="_blank" href="#"></a></i>
                            <i><a rel="nofollow" class="fa fa-instagram" target="_blank" href="#"></a></i>
                            <i><a rel="nofollow" class="fa fa-vk" target="_blank" href="#"></a></i>
                            <i><a rel="nofollow" class="fa fa-facebook" target="_blank" href="#"></a></i>
                        </div-->
                        <!-- /noindex -->
                        <p><?=$item->description?></p>
                        <?php /* <p><b>Минимальная розничная цена : <span><?=$item->price?>р.</span></b></p> */ ?>
                        <div class='table_param'>
                            <table>
                                <thead>
                                <tr>
                                    <th>Пищевая ценность</th>
                                    <th>в порции <?=$item->portion->portion_weight?> г.</th>
                                    <th>на 100 г.</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Калории</td>
                                    <td><?=$item->portion->energy?> ккал</td>
                                    <td><?=$item->portion->energy_per_100?> ккал</td>
                                </tr>
                                <tr>
                                    <td>Белки</td>
                                    <td><?=$item->portion->protein?> г</td>
                                    <td><?=$item->portion->protein_per_100?> г</td>
                                </tr>
                                <tr>
                                    <td>Жиры</td>
                                    <td><?=$item->portion->fat?> г</td>
                                    <td><?=$item->portion->fat_per_100?> г</td>
                                </tr>
                                <tr>
                                    <td>Углеводы</td>
                                    <td><?=$item->portion->carbs?> г</td>
                                    <td><?=$item->portion->carbs_per_100?> г</td>
                                </tr>
                                <?php foreach ($item->portion->properties as $prop) { ?>
                                    <tr>
                                        <td><?=$prop->name?></td>
                                        <td><?=$prop->value?> г</td>
                                        <td><?=$prop->value_per_100?> г</td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class='product_full-taste'>
                    <article class='desc'>
                        <?=$item->portion->description?>
                    </article>
                </div>
            </div>
            <!-- Продукция END -->
            <?php
            /*
            <!-- Общий блок с комментариями -->
            <article class='comments'>
                <div class='zag_comments'>
                    <h3>Отзывы</h3><a href='#' class='write_comment fa fa-pencil-square-o'><span>НАПИСАТЬ ОТЗЫВ</span></a>
                </div>
                <div class="comment"><!-- Один комментарий -->
                    <aside class="text">
                        <p>Отличный протеин. Вкус - ванильное мороженое, других пока не пробовал =) Мешаю с водой, очень вкусно, как будто с молоком. Пью сразу как проснулся и после тренировки. Усваивается отлично, никаких проблем не было за месяц использования.</p>
                        <div class="dop_comment">
                            <div class="plus_minus">
                                <div class="plus fa fa-plus-circle">только плюсы</div>
                                <div class="minus fa fa-minus-circle">не обнаружено)</div>
                            </div>
                            <div class="raiting_data">
                                <div class="raiting">
                                    <span class='star fa fa-star'></span>
                                    <span class='star fa fa-star'></span>
                                    <span class='star fa fa-star'></span>
                                    <span class='star fa fa-star'></span>
                                    <span class='star fa fa-star'></span>
                                </div>
                                <span class="data">16.08.2015</span>
                            </div>
                        </div>
                    </aside>
                    <div class='comment_img'>
                        <img src="<?=Yii::getAlias('@web/img/comment_img.jpg')?>" alt="">
                        <span class='comment_name'>Витя</span>
                    </div>
                </div><!-- Один комментарий END -->
                <div class="comment"><!-- Один комментарий -->
                    <aside class="text">
                        <p>Пользуюсь в течении 1 года. Нравится соотношение цена-объем-качество+скидка за ценник. Принимаю утром на тощак, после тренировки и иногда если не смог перекусить. Отличная переносимость. Эффект зависит от усердий в зале:))</p>
                        <div class="dop_comment">
                            <div class="plus_minus">
                                <div class="plus fa fa-plus-circle">цена</div>
                                <div class="minus fa fa-minus-circle">изжога</div>
                            </div>
                            <div class="raiting_data">
                                <div class="raiting">
                                    <span class='star fa fa-star'></span>
                                    <span class='star fa fa-star'></span>
                                    <span class='star fa fa-star'></span>
                                    <span class='star fa fa-star'></span>
                                    <span class='star fa fa-star'></span>
                                </div>
                                <span class="data">16.08.2015</span>
                            </div>
                        </div>
                    </aside>
                    <div class='comment_img'>
                        <img src="<?=Yii::getAlias('@web/img/comment_img2.jpg')?>" alt="">
                        <span class='comment_name'>Серега</span>
                    </div>
                </div><!-- Один комментарий END -->
            </article>
            <!-- Общий блок с комментариями END -->
            */
            ?>
        </article>
    </div>
</div><!-- Боковая навигация и контентная часть END -->