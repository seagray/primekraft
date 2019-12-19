<?php
use yii\helpers\Html;
use \yii\helpers\Url;
use app\helpers\Image;

/**
 * @var $combobox \app\models\Category[]
 * @var $singletaste \app\models\Category[]
 */

?>
<div class='wrapper'><!-- Боковая навигация и контентная часть -->
    <div class="group">
        <article class="content"><!-- Контент -->
            <div class='main_production'>
                <?php if (isset($this->context->h1) && !empty($this->context->h1)) { ?>
                    <h1><?=Html::encode($this->context->h1)?></h1>
                <?php } else { ?>
                    <h1><?=Html::encode($group->name)?></h1>
                <?php } ?>
                <div class='group'>
                    <div class='main_production-wrap flex'>
                        <?php foreach ($group->categories as $cat) {?>
                            <figure class="item_el col-sm-4 col-xs-6">
                                <a href="<?=$cat->url?>">
                                    <div class="item_el-wrap">
                                        <img src="<?= Yii::getAlias('@web') . Image::thumbnail($cat->image, 160, 250) ?>"  alt="<?=$cat->name?>" />
                                        <h4><?=$cat->name?></h4>
                                    </div>
                                    <?=$cat->description?>
                                </a>
                            </figure>
                        <?php } ?>
                    </div>

                    <?php /*
                    <div class='main_production-wrap'>
                        <?php foreach ($combobox as $cat) {?>
                            <figure class="item_el col-sm-4 col-xs-6">
                                <a href="<?=$cat->url?>">
                                    <div class="item_el-wrap">
                                        <img src="<?= Yii::getAlias('@web') . Image::thumbnail($cat->image, 160, 250) ?>"  alt="<?=$cat->name?>" />
                                        <h4><?=$cat->name?></h4>
                                    </div>
                                    <?=$cat->description?>
                                </a>
                            </figure>
                        <?php } ?>
                    </div>
                    <div class='main_production-wrap'>
                        <div class='group'>
                            <?php foreach ($singletaste as $cat) {?>
                                <figure class="item_el col-sm-4 col-xs-6">
                                    <a href="<?=$cat->url?>">
                                        <div class="item_el-wrap">
                                            <img src="<?= Yii::getAlias('@web') . Image::thumbnail($cat->image, 180, 190) ?>"  alt="<?=$cat->name?>" />
                                            <h4><?=$cat->name?></h4>
                                        </div>
                                        <?=$cat->description?>
                                    </a>
                                </figure>
                            <?php } ?>
                        </div>
                    </div>
                    */ ?>
                </div>
            </div>
            <div class="catalogue-text">
                <p><?=$group->text?></p>
            </div>
        </article>
    </div>
</div>