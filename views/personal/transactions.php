<?php
use \yii\helpers\Url;
use app\helpers\Image;

/**
 * @var $combobox \app\models\Category[]
 * @var $singletaste \app\models\Category[]
 * @var boolean $isFiltered
 */
?>
<div class='wrapper'><!-- Боковая навигация и контентная часть -->
    <div class="group">
        <div class="lk">
            <?=$this->render('inc/menu')?>
            <article class="content"><!-- Контент -->
                <?php if (isset($this->context->h1) && !empty($this->context->h1)) { ?>
                    <h1><?=\yii\helpers\Html::encode($this->context->h1)?></h1>
                <?php } else { ?>
                    <h1>Детализация счёта</h1>
                <?php } ?>
                <div class="personalInfo">
                    <?php /*
                    <div class="info_score">
                        <div class="info_score_row">
                            <div class="text">Зачислено</div>
                            <div class="price"><span><?=number_format($user->pay, 2, ',', ' ')?></span> р.</div>
                        </div>
                        <div class="info_score_row">
                            <div class="text">Выведено</div>
                            <div class="price"><span><?=number_format($user->payout, 2, ',', ' ')?></span> р.</div>
                        </div>
                    </div>
                    */ ?>
                    <?php if (!empty($arItems) || $isFiltered) { ?>
                        <?=$this->render('inc/filter_date.php', ['params' => $params])?>
                        <div class="lk_table score">
                            <?php if (!empty($arItems)) { ?>
                                <table>
                                    <thead>
                                    <tr>
                                        <th><span class="sort">дата</span></th>
                                        <th>описание</i></th>
                                        <th class="last">Сумма</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($arItems as $obTransaction){?>
                                        <tr>
                                            <td><?=date('d.m.Y', strtotime($obTransaction->date))?></td>
                                            <td><?=$obTransaction->comment?></td>
                                            <td><?=$obTransaction->sum?></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            <?echo \yii\widgets\LinkPager::widget([
                                'pagination' => $pagination,
                            ]);?>
                            <?php } else { ?>
                                <p>Ничего не найдено</p>
                            <?php } ?>
                        </div>
                        <?php } else { ?>
                            <p>Здесь отображаются все изменения Вашего личного счета в системе. Как только заказ,
                                оформленный по Вашему промокоду, будет оплачен, на этой странице появится информация о
                                начислении по заказу. Так же здесь отображается вывод средств.</p>
                        <?php } ?>
                </div>
            </article>
        </div>
    </div>
</div>



