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
                    <h1>Вывод средств</h1>
                <?php } ?>
                <div class="personalInfo">
                    <?php if (!empty($arItems) || $isFiltered) { ?>
                        <?=$this->render('inc/filter_date.php', ['params' => $params])?>
                        <div class="lk_table score">
                            <?php if (!empty($arItems)) { ?>
                                <table>
                                    <thead>
                                    <tr>
                                        <th>номер</th>
                                        <th><span class="sort">дата</span></th>
                                        <th>статус</th>
                                        <th class="last">сумма</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($arItems as $pay){?>
                                        <tr>
                                            <td><?=$pay->id?></td>
                                            <td><?=date('d.m.Y', strtotime($pay->date))?></td>
                                            <td><?=$pay->statusText?></td>
                                            <td><?=number_format($pay->sum, 2, ',', ' ')?></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                                <?echo \yii\widgets\LinkPager::widget([
                                    'pagination' => $pagination,
                                ]);?>
                            <?php } else { ?>
                                <p>Ничего не найдено.</p>
                            <?php } ?>
                        </div>
                    <?php } else { ?>
                        <p>Вы пока не запрашивали выплату денег. Как только Ваш счет достигнет <?=\Yii::$app->params['discountMinPayout']?> р.
                            Вы сможете получить деньги любым удобным для Вас способом
                        </p>
                    <?php } ?>
                </div>
            </article>
        </div>
    </div>
</div>



