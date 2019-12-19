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
            </aside>
            
            <!-- Breadcrumbs END -->
            <h3>Продукция</h3>
            <?=$this->render('inc/menu', ['menu' => $menu, 'current_category_id' => $item->category->id, 'current_item_id' => $item->id]) ?>
        </aside><!-- Боковая навигация END -->
        <article class="content"><!-- Контент -->
            <?php if (isset($this->context->h1) && !empty($this->context->h1)) { ?>
                <h1><?=Html::encode($this->context->h1)?></h1>
            <?php } else { ?>
                <h1><?=Html::encode($item->name)?></h1>
            <?php } ?>
            <!-- Продукция -->
            <div class="product_full">
                <div class='product_full-desc group'>
                    <div class="clearfix">
                        <div class="col-lg-4 col-sm-4">
                            <?=$this->render('inc/item-images', ['item' => $item]) ?>
                        </div>
                        <div class='col-lg-5 col-sm-8'>
                            <div class="visible-xs">
                                <?=$this->render('inc/item-images-controls', ['item' => $item]) ?>
                            </div>
                            <div class="hidden-lg bsWrap clearfix">
                                <?=$this->render('inc/store-buttons', ['item' => $item]) ?>
                            </div>
                            <?php /*
                            <!-- noindex -->
                            <div class="soc_icons" data-brackets-id="4343"><!-- noindex -->
                                <i data-brackets-id="4344"><a rel="nofollow" class="fa fa-twitter" target="_blank" href="#" data-brackets-id="4345"></a></i>
                                <i data-brackets-id="4346"><a rel="nofollow" class="fa fa-instagram" target="_blank" href="#" data-brackets-id="4347"></a></i>
                                <i data-brackets-id="4348"><a rel="nofollow" class="fa fa-vk" target="_blank" href="#" data-brackets-id="4349"></a></i>
                                <i data-brackets-id="4350"><a rel="nofollow" class="fa fa-facebook" target="_blank" href="#" data-brackets-id="4351"></a></i>
                            </div>
                            <!-- /noindex -->
                            */ ?>

                            <?php /*   <p><b>Минимальная розничная цена : <span><?=$item->price?>р.</span></b></p> */ ?>
                            <p class="first-par">Вес упаковки : <b><?=$item->weight?> г.</b><br>
                                количество порций : <b><?=$item->portions_count?> порций</b><br>
                            <p>Вкусы:
                                <span><b>
                                    <?php foreach ($item->flavors as $k=>$f) {
                                        echo ($k?', ':''), $f->name;
                                    } ?>
                                </b></span>
                            </p>
                            <div class="hidden-xs">
                                <?=$this->render('inc/item-images-controls', ['item' => $item]) ?>
                            </div>
                        </div>
                        <div class="col-sm-3 visible-lg bsWrap">
                            <?=$this->render('inc/store-buttons', ['item' => $item]) ?>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <p>
                            <?=$item->description?>
                        </p>
                    </div>
                </div>
            </div>
                <div class='product_full-taste'>
                    <div class="tab_item">
                        <?php foreach ($item->flavors as $k=>$f){?>
                            <span title="<?=$f->name_small?>" data-item='<?=$f->hash?>' class='<?=(!$k?'active':'')?>'><?=$f->name?></span>
                        <?php } ?>
                    </div>
                    <div class="select_item">
                        <select>
                            <?php foreach ($item->flavors as $f){?>
                                <option value="<?=$f->hash?>"><?=$f->name?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="tab_cont">
                        <?php foreach ($item->portions as $k=>$portion){?>
                        <div data-cont='<?=$portion->flavor->hash?>' class='<?=($k?:"active")?>'>
                            <div class="group">
                                <div class='table_param col-sm-7'>
                                    <table>
                                        <thead>
                                        <tr>
                                            <th>Пищевая ценность</th>
                                            <th>в порции <?=$portion->portion_weight?> г.</th>
                                            <th>на 100 г.</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Калории</td>
                                            <td><?=$portion->energy?> ккал</td>
                                            <td><?=$portion->energy_per_100?> ккал</td>
                                        </tr>
                                        <tr>
                                            <td>Белки</td>
                                            <td><?=$portion->protein?> г</td>
                                            <td><?=$portion->protein_per_100?> г</td>
                                        </tr>
                                        <tr>
                                            <td>Жиры</td>
                                            <td><?=$portion->fat?> г</td>
                                            <td><?=$portion->fat_per_100?> г</td>
                                        </tr>
                                        <tr>
                                            <td>Углеводы</td>
                                            <td><?=$portion->carbs?> г</td>
                                            <td><?=$portion->carbs_per_100?> г</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class='img_taste col-sm-5'>
                                    <img src="<?=Yii::getAlias('@web').$portion->flavor->image?>" alt="<?=$portion->flavor->name?>">
                                </div>
                            </div>
<!--                            <article class='desc'>-->
<!--                                --><?//=$portion->description?>
<!--                            </article>-->
                        </div>
                        <?php } ?>
                    </div>
                </div>

                <?php /*
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
                */ ?>
            </div>
            <!-- Продукция END -->
        </article>
    </div>
</div><!-- Боковая навигация и контентная часть END -->