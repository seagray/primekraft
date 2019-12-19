<?php
/**
 * @var $item \app\models\Product
 * @var $width integer
 * @var $height integer
 */
$images = json_decode($item->images, true);
?>
<?php if (isset($images[0])) { ?>
    <img src="<?=Yii::getAlias('@web') . \app\helpers\Image::thumbnail($images[0], 270, 291)?>" alt="<?=$item->name?>" class='prod_main-img' />
<?php } ?>
