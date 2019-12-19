<?php
use yii\helpers\Html;
use \yii\helpers\Url;
use app\helpers\Image;

/**
 * @var array $arItems
 */

?>
<div class='wrapper'><!-- Боковая навигация и контентная часть -->
    <div class="group">
        <article class="content"><!-- Контент -->
            <div class="cart">
                <?php if (isset($this->context->h1) && !empty($this->context->h1)) { ?>
                    <h1><?=Html::encode($this->context->h1)?></h1>
                <?php } else { ?>
                    <h1>Корзина</h1>
                <?php } ?>
                <?php if ($cartCount > 0) { ?>
                <div class="cartTable">
                    <table>
                        <thead>
                        <tr>
                            <th>&nbsp;</th>
                            <th>Название</th>
                            <th>цена</th>
                            <th>количество</th>
                            <th>Скидка</th>
                            <th>сумма</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($arItems as $nId=>$arItem){ ?>
                            <tr data-item="<?=$nId?>">
                            <td>
                                <?=$this->render('@app/views/catalogue/inc/item-first-image', ['item' => $arItem['object'], 'width' => 70, 'height' => 120]) ?>
                            </td>
                            <td class="name-product bold"><?=$arItem['object']->displayName?></td>
                            <td><span class="price_<?=$nId;?>"><?=$arItem['price'];?></span> р.</td>
                            <td>
                                <div class="quantity">
                                    <i class="fa fa-minus minus js-minus c" id="<?=$nId;?>"></i>
                                    <input type="text" class="product_count <?=$nId;?>" id="<?=$nId;?>" value="<?=$arItem['count'];?>">
                                    <i class="fa fa-plus plus js-plus c" id="<?=$nId;?>"></i>
                                </div>
                            </td>
                            <td><span class="discount_<?=$nId;?>"><?=$arItem['discount'];?></span> р.</td>
                            <td class="bold"><span class="popup_sum_product_<?=$nId;?>"><?=($arItem['price']*$arItem['count']) - $arItem['discount'];?></span> р.</td>
                            <td class="trash"><i class="fa fa-trash js-del del" data-id="<?=$nId?>"></i></td>
                        </tr>
                        <?php } ?>

                        </tbody>
                    </table>
                </div>
                <form method="post" action="<?=Url::to(['card/order'])?>" id="form">
                    <div class="promocode">
                        <div class="promocodeInput">
                            <span>Промокод</span>
                            <p>Если у вас есть промокод укажите его и получите скидку</p>
                            <div class="addPromocode">
                                <input type="text" name="code" placeholder="" class="code<?=(!empty($arFields['code']) ? ' success' : '')?>" <?=(!empty($arFields['code']) ? 'readonly' : '')?> value="<?=$arFields['code'];?>">
                                <?php if (empty($arFields['code'])) { ?>
                                    <div class="button_link--default">
                                        <a href="#" class="button_link" id="apply_discount"><span>применить</span></a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="promocodePrice">
                            <div class="promocodePrice-row">
                                <span class="promocodePrice-text">Сумма:</span>
                                <span class="promocodePrice-price" ><span id="sum" class="sum"><?=$nSum;?></span> p.</span>
                            </div>
                            <div class="promocodePrice-row">
                                <span class="promocodePrice-text">Скидка:</span>
                                <span class="promocodePrice-price prcode"><span id="discount" class="discount"><?=$nDiscount;?></span> p.</span>
                            </div>
                            <div class="promocodePrice-row">
                                <span class="promocodePrice-text total">Итого:</span>
                                <span class="promocodePrice-price total"><span id="total" class="total"><?=$nTotal;?></span> p.</span>
                            </div>
                        </div>
                    </div>
                    <div class="decor">


                        <h2>Оформление заказа</h2>
                        <?php if (Yii::$app->session->getFlash('order')) { ?>
                            <div class="row">
                                <div class="card-box">
                                    <?= Yii::$app->session->getFlash('order'); ?>
                                </div>
                            </div>
                        <?php } ?>
                        <p class="decorTitle">Укажите свои личные данные для связи и расчёта стоимости  доставки.</p>
                        <div class="decorForm">
                            <div class="decorSection">
                                <div class="decorField">
                                    <input type="text" required="" name="name" placeholder="ФИО*" value="<?=$arFields['name']?>"<?=(!empty($arFields['name']) ? ' class="success"' : '')?> />
                                    <input type="text" required="" name="phone" placeholder="Телефон*" value="<?=$arFields['phone']?>"<?=(!empty($arFields['phone']) ? ' class="success"' : '')?> />
                                    <input type="email" required="" name="email" placeholder="Почта*" value="<?=$arFields['email']?>"<?=(!empty($arFields['email']) ? ' class="success"' : '')?> />
                                    <input type="text" required="" name="city" placeholder="Город доставки*" value="<?=$arFields['email']?>"<?=(!empty($arFields['email']) ? ' class="success"' : '')?> />
                                    <input type="text" required="" name="address" placeholder="Адрес доставки*" value="<?=$arFields['address']?>"<?=(!empty($arFields['address']) ? ' class="success"' : '')?> />
                                    <input type="text" name="delivery_price" placeholder="Доставка" disabled="disabled" />
                                    <script type="text/javascript">
                                        window.addEventListener('load', function () {
                                            $('head').append($('<script>').attr('src', "<?=Yii::getAlias("@web/js/jquery-autocomplete.js")?>").attr('type', 'text/javascript'))
                                                .append($('<link>').attr('href', "<?=Yii::getAlias("@web/css/autocomplete.css")?>").attr('rel', 'stylesheet'));
                                            var $input = $('input[name="address"]');
                                            $input.data('prevValue', $input.val());
                                            $input.trigger('change');
                                            $input.on('change', function() {
                                               $input.data('prevValue', $input.val());
                                            });
                                            /*
                                            $input.autocomplete({
                                                lookup: function (q, done) {
                                                    $.ajax({
                                                        url: 'https://maps.googleapis.com/maps/api/geocode/json?address=' + encodeURIComponent(q),
                                                        dataType: 'json',
                                                        success: function (data) {
                                                            var result = {suggestions: []};
                                                            if (data.status == 'OK') {
                                                                $(data.results).each(function (i, el) {
                                                                    result.suggestions.push({value: el.formatted_address, data: el});
                                                                });
                                                                $('.not-found').detach();
                                                            } else {
                                                                if(!$('.not-found').length){
                                                                    $( "<div class='not-found'>Ничего не найдено</div>" ).insertAfter( 'input[name="address"]' );
                                                                } else {
                                                                    if($('.not-found').length){}
                                                                    else { $('.not-found').detach(); }
                                                                }
                                                                $input.on('change', function() {
                                                                    if($(this).val() == ''){
                                                                        $('.not-found').detach();
                                                                    }
                                                                });
                                                                //result.suggestions.push({value: "Ничего не найдено", data: {}});
                                                            }
                                                            done(result);
                                                        }
                                                    });
                                                },
                                                onSelect: function (item) {
                                                    if (item.value != "Ничего не найдено") {
                                                        $input.val(item.value);
                                                        $input.data('prevValue', item.value);
                                                        $input.trigger('change');
                                                    } else {
                                                        var prevValue = $input.data('prevValue');
                                                        if (typeof prevValue == 'undefined') {
                                                            prevValue = '';
                                                        }
                                                        $input.val(prevValue);
                                                        $input.trigger('change');

                                                    }
                                                },
                                                deferRequestBy: 500
                                            });
                                            */
                                        });
                                    </script>
                                </div>
                                <?php /*
                                <div class="decorInfo">
                                    <p><span>Внимание!</span> Стоимость заказа может измениться в зависимости от доставки!
                                    <p><a href="/delivery" target="_blank" class="">Подробнее об условиях доставки</a></p>
                                </div>
                                */ ?>
                            </div>

                            <label class="radio-services">
                                <input type="radio" name="pay_on_delivery" class="js-pay-online" value="0" <?=(!$arFields['pay_on_delivery'] ? 'checked="checked"' : '')?> />
                                <i class="fa fa-circle-o"><i class="fa fa-circle"></i></i>
                                <span>Оплата картой</span>
                            </label>

                            <label class="radio-services js-pay_on_delivery">
                                <input type="radio" name="pay_on_delivery" class="js-pay-offline" value="1" <?=($arFields['pay_on_delivery'] ? 'checked="checked"' : '')?> />
                                <i class="fa fa-circle-o"><i class="fa fa-circle"></i></i>
                                <span>Оплата при получении</span>
                            </label>

                            <label class="check-services">
                                <input type="checkbox" name="sign" value="1" class="sign" />
                                <i class="fa fa-square-o" aria-hidden="true"><i class="fa fa-check" aria-hidden="true"></i></i>
                                <span>я согласен с <a href="#regulations" target="_blank" class="modal">правилами работы сервиса</a><i>*</i></span>
                                <div class="errorCheck">Вы должны согласиться с правилами работы сервиса!</div>
                            </label>
                            <div class="decorSection last">
                                <div class="decorField">
                                    <textarea placeholder="Пожелания" name="description" rows="8" cols="15"><?=$arFields['description'];?></textarea>
                                </div>
                                <div class="decorInfo">
                                    <p>После отправки заказа наш менеджер перезвонит вам в течение <span>2-х часов</span>. Если у вас есть особые пожелания по времени звонка, укажите их.</p>
                                </div>
                            </div>
                            <div class="decorSend">
                                <div class="button_link--default">
                                    <button class="button_link" type="submit"><span>Отправить заказ</span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <?php } else { ?>
                    <div class="success-cart">
                            <h4>Ваша корзина пуста</h4>
                    </div>
                <?php } ?>
            </div>
        </article>
    </div>
</div>

<div class='popup mfp-hide' id='regulations'>
    <?=\app\models\Content::text('service.rules.popup', '
    <h2>Правила работы сервиса!</h2>
    <p>Я подтверждаю, что в целях заключения и исполнения договора по оказанию услуг купли-продажи, я даю компании ООО «ПРАЙМ-КРАФТ» свое согласие на сбор, запись, обработку, использование и удаление моих идентификационных данных (в том числе и с помощью третьих лиц), к которым относятся: фамилия, имя, отчество, номер мобильного телефона и адрес электронной почты. Также я разрешаю ООО «ПРАЙМ КРАФТ» обрабатывать все вышеперечисленные мной идентификационные данные с целью дополнительного информирования об услугах, товарах, акциях и работах ООО «ПРАЙМ-КРАФТ», а также его партнеров. Я в любой момент могу отозвать свое согласие, отправив письмо о моем намерении на электронную почту <a href="mailto:info@primekraft.ru">info@primekraft.ru</a>.</p>
    ')?>
</div>
