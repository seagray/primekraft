<div class='wrapper'><!-- Боковая навигация и контентная часть -->
    <div class="group">
        <article class="content"><!-- Контент -->
            <div class='main_production'>
                <?php if (isset($this->context->h1) && !empty($this->context->h1)) { ?>
                    <h1><?=\yii\helpers\Html::encode($this->context->h1)?></h1>
                <?php } else { ?>
                    <h1>Страница заказа</h1>
                <?php } ?>
                <table>
                    <tr>
                        <td>Название</td>
                        <td>Кол-во</td>
                        <td>Стоимость</td>
                    </tr>
                    <?php foreach($arItems as $nId=>$arItem){?>
                        <tr class="row_<?=$nId;?>">
                            <td><a href="<?=\yii\helpers\Url::toRoute(['catalogue/item', 'id' =>$nId])?>"><?=$arItem['name'];?></a></td>
                            <td><input type="number" class="count" id="<?=$nId;?>" value="<?=$arItem['count'];?>"></td>
                            <td><?=$arItem['price'];?></td>
                        </tr>
                    <?php } ?>
                </table><br>
                <span>Общая стоимость: <span class="total"><?=$nTotal;?></span></span>


            </div>
        </article>
    </div>
</div>


