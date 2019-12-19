<?php
use yii\helpers\Url;
/**
 * @var $category \app\models\Category
 * @var $menu \app\models\Category[]
 * @var $current_category \app\models\Category
 */
?>

<select class='sidebar_nav--on-mobile js-select-loc'>
    <?php foreach ($menu as $cat) { ?>
        <option value="<?=Url::toRoute(['catalogue/category', 'id' => $cat->id])?>"<?php if ($cat->id == $current_category_id){?> selected="selected"<?php } ?>><?=$cat->name?></option>
    <?php } ?>
</select>
<ul class="sidebar_nav">
    <?php foreach ($menu as $cat) { ?>
        <li<?php if ($cat->id == $current_category_id){?> class="active"<?php } ?>>
            <a href="<?=$cat->url?>"><?=$cat->name?></a>
            <!-- Подменю расспологается между ссылкой и кнопкой расскрытия -->
            <ul class='sub_Nav'>
                <?php foreach ($cat->products as $item){ ?>
                    <li<?php if (isset($current_item_id) && ($item->id == $current_item_id)){?> class="active"<?php } ?>>
                        <a href="<?=$item->url?>"><?=$item->name?></a>
                    </li>
                <?php } ?>
            </ul>
            <span class='openSub'></span>
        </li>
    <?php } ?>
</ul>