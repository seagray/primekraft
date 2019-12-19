<?php
use \yii\helpers\Url;
use app\helpers\Image;

?>
<div class='wrapper'><!-- Боковая навигация и контентная часть -->
    <div class="group">
        <article class="content"><!-- Контент -->
            <div class='main_production'>
                <?php if (isset($this->context->h1) && !empty($this->context->h1)) { ?>
                    <h1><?=\yii\helpers\Html::encode($this->context->h1)?></h1>
                <?php } else { ?>
                    <h1>Продукция</h1>
                <?php } ?>
                <div class='group'>
                    <?php foreach (\app\models\Category::findListByLines() as $line) {?>
                        <div class='main_production-wrap'>
                            <div class='group'>
                                <?php foreach ($line as $cat) {?>
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
                    <?php } ?>
                </div>
            </div>
        </article>
    </div>
</div>