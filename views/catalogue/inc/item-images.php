<?php
/**
 * @var $item \app\models\Product
 */
?>
<div class="product-images">
    <?php $images = json_decode($item->images, true); ?>
    <div class="product-image-main">
        <?php foreach ($images as $img) {?>
            <div>
                <img src="<?=Yii::getAlias('@web') . \app\helpers\Image::thumbnail($img, 345, 363)?>" alt="<?=$item->category->name?>" class='prod_main-img'>
            </div>
        <?php } ?>
    </div>
</div>
