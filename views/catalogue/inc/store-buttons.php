<?php
/**
 * @var \app\models\Product $item
 */
?>
<?php if ($item->hasMarketUrl()) { ?>
    <div class="buySector">
        <span>купить на:</span>
        <?php if ($item->ozon_url && $item->ozon_url_http_ok) { ?>
            <a href="<?= $item->ozon_url ?>" class="storeSector" target="_blank" rel="nofollow">
                <img src="<?= Yii::getAlias('@web/img/stores/ozon.png') ?>" alt="ozon.ru">
            </a>
        <?php } ?>
        <?php if ($item->ulmart_url && $item->ulmart_url_http_ok) { ?>
            <a href="<?= $item->ulmart_url ?>" class="storeSector" target="_blank" rel="nofollow">
                <img src="<?= Yii::getAlias('@web/img/stores/ulmart.png') ?>" alt="ulmart.ru">
            </a>
        <?php } ?>
        <?php if ($item->wildberries_url && $item->wildberries_url_http_ok) { ?>
            <a href="<?= $item->wildberries_url ?>" class="storeSector" target="_blank" rel="nofollow">
                <img src="<?= Yii::getAlias('@web/img/stores/wildberries.png') ?>" alt="wildberries.ru">
            </a>
        <?php } ?>
    
            <div class="buttonSector">
                <div class="button_link--default">
                    <?php if ($item->available) { ?>
                        <a id="<?=$item->id;?>" class="button_link buy" data-addToCart="">
                            <span>добавить в корзину</span>
                        </a>
                    <?php } else { ?>
                        <span>временно нет в наличии</span>
                    <?php } ?>
                </div>
            </div>
    </div>
<?php } ?>
