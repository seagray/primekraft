<?php
/**
 * @var \app\models\Discount $discount
 * @var float $newOrdersSum
 */

use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class='wrapper'><!-- Боковая навигация и контентная часть -->
    <div class="group">
        <div class="lk">
            <?=$this->render('inc/menu.php')?>
            <article class="content"><!-- Контент -->
                <?php if (isset($this->context->h1) && !empty($this->context->h1)) { ?>
                    <h1><?=Html::encode($this->context->h1)?></h1>
                <?php } else { ?>
                    <h1>Личный кабинет</h1>
                <?php } ?>
                <div class="personalInfo">
                    <?php if ($discount) { ?>
                        <form method="post">
                            <div class="promocodeInput">
                                <span>Промокод</span>
                                <ol>
                                    <li>Создайте свой промокод ниже</li>
                                    <li>Расскажите о нем знакомым</li>
                                    <li>За каждый оформленный по промокоду заказ вам будут начисляться проценты
                                        <ul>
                                            <li>10% скидка на покупку продукции по промокоду</li>
                                            <li>15% начисляется владельцу промокода</li>
                                            <li>5% начисляется по реферальной программе</li>
                                        </ul>
                                    </li>
                                </ol>

                                <div class="addPromocode">
                                    <input type="text" name="code" value="<?=$discount->code;?>" placeholder="Укажите промокод" <?=(!empty($discount->is_order) ? 'readonly' : '')?> />
                                    <?php if(empty($discount->is_order)) { ?>
                                    <div class="button_link--default">
                                        <button type="submit" name="code_change" class="button_link">
                                            <span><?=$discount->code ? "Изменить" : "Добавить"?></span>
                                        </button>
                                        <i></i>
                                    </div>
                                    <?php } ?>
                                    <p class="help">Вы можете изменить промокод до того момента пока первый покупатель не воспользуется им для получения скидки на заказ</p>
                                </div>
                                <?php if ($discount->errors) {?>
                                    <p class="error-promocode">
                                        <?=$discount->errors['code'][0]?>
                                    </p>
                                <?php }?>
                            </div>
                        </form>
                        <?php if ($discount->code) { ?>
                            <br>
                            <label class="click-promo">
                            <span>Ваша личная промо-ссылка:</span>
                                <span class="promocodeInput">
                                    <span class="addPromocode">
                                        <input style="text-transform:lowercase" type="text" readonly value="<?=(Url::base(true) . '/?promo=' . $discount->code)?>">
                                    </span>
                                </span>
                            </label>
                        <?php } ?>
                    <?php } ?>
                    <form method="post">
                        <input type="hidden" name="payout" value="1" />
                        <div class="promocodePrice">
                            <span>Личный счет</span>
                            <div class="promocodePrice-row">
                                <span class="promocodePrice-text">Новые заказы:</span>
                                <span class="promocodePrice-price"><span><?=number_format($newOrdersSum, 2, ',', ' ')?></span> p.</span>
                            </div>
                            <div class="promocodePrice-row">
                                <span class="promocodePrice-text">Заработано на рефералах:</span>
                                <span class="promocodePrice-price"><span><?=number_format($referralsSum, 2, ',', ' ')?></span> p.</span>
                            </div>
                            <div class="promocodePrice-row">
                                <span class="promocodePrice-text">Состояние счета:</span>
                                <span class="promocodePrice-price"><span><?=number_format($user->hold, 2, ',', ' ')?></span> p.</span>
                            </div>
                            <div class="promocodePrice-row">
                                <span class="promocodePrice-text">Доступно для вывода:</span>
                                <span class="promocodePrice-price"><span><?=number_format($sum, 2, ',', ' ')?></span> p.</span>

                                <?php if($sum >=\Yii::$app->params['discountMinPayout']) { ?>
                                <div class="button_link--default">
                                    <a href="#" class="button_link js-submit"><span>вывести</span></a>
                                </div>
                                <?php } ?>
                            </div>
    <!--                        <div class="promocodePrice-row">-->
    <!--                            <span class="promocodePrice-text">Текущие операции:</span>-->
    <!--                            <span class="promocodePrice-price"><span class="empty">нет</span></span>-->
    <!--                        </div>-->
                        </div>
                    </form>
                </div>
            </article>
        </div>
    </div>
</div>
