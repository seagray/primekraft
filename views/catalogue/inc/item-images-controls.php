<?php
/**
 * @var $item \app\models\Product
 */
?>
<div class="product-images">
    <?php $images = json_decode($item->images, true); ?>
    <?php if (count($images) > 1) { ?>
    <div class="clear"></div>
    <div class="product-images-nav">
        <?php foreach ($images as $img) {?>
            <div>
                <img src="<?=Yii::getAlias('@web') . \app\helpers\Image::thumbnail($img, 50, 50)?>" alt="<?=$item->name?>" class='prod_main-img'>
            </div>
        <?php } ?>
    </div>
    <?php } ?>
</div>
