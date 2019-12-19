
<?php
$this->registerJsFile('/js/card-ajax.js');
?>
<aside class="cartModal">
    <i class="fa fa-times close"></i>
    <div class="topPanel">
        <h3>Корзина</h3>
        <div class="price"><span class="count_popup"><?=$count;?></span> <?=\app\components\types\String::spellAmount($count,'товар,товара,товаров');?> на сумму <span class="popup_sum"><?=$total;?> р.</span></div>
    </div>
    <div class="hidden-table">
        <table>
            <thead>
            <tr>
                <th>Название</th>
                <th>цена</th>
                <th>количество</th>
                <th>сумма</th>
                <th>&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            <?php if(!empty($items)){?>
            <?php foreach($items as $nId=>$arItem){?>
                    <tr data-item="<?=$nId?>">
                <td class="name-product bold"><?=$arItem['name'];?></td>
                <td><span class="price_<?=$nId;?>"><?=$arItem['price'];?></span> р.</td>
                <td>
                    <div class="quantity">
                        <i class="fa fa-minus minus js-minus" id="<?=$nId;?>"></i>
                        <input type="text" class="product_count <?=$nId;?>" id="<?=$nId;?>" value="<?=$arItem['count'];?>">
                        <i class="fa fa-plus plus js-plus" id="<?=$nId;?>"></i>
                    </div>
                </td>
                <td class="bold"><span class="popup_sum_product_<?=$nId;?>"><?=$arItem['count']*$arItem['price'];?></span> р.</td>
                <td><i class="fa fa-trash js-del del" data-id="<?=$nId?>"></i></td>
            </tr>
            <?php } ?>
            <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="bottomPanel">
        <div class="button_link--default">
            <a href="<?= \yii\helpers\Url::toRoute(['/card']) ?>" class="button_link"><span>перейти в корзину</span></a>
        </div>
        <span class="continue">продолжить покупки</span>
    </div>
</aside>
