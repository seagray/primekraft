<?php
use \yii\helpers\Url;
use app\helpers\Image;

/**
 * @var $combobox \app\models\Category[]
 * @var $singletaste \app\models\Category[]
 */
?>
<div class='wrapper'><!-- Боковая навигация и контентная часть -->
    <div class="group">
        <div class="lk">
            <?=$this->render('inc/menu.php')?>
            <article class="content"><!-- Контент -->
                <?php if (isset($this->context->h1) && !empty($this->context->h1)) { ?>
                    <h1><?=\yii\helpers\Html::encode($this->context->h1)?></h1>
                <?php } else { ?>
                    <h1>Заказы по промокоду</h1>
                <?php } ?>
                <div class="personalInfo">
                    <?php if (!empty($arItems) || $isFiltered) { ?>
                        <?=$this->render('inc/filter_date.php', ['params' => $params])?>
                        <div class="lk_table">
                            <?php if (!empty($arItems)) { ?>
                                <table>
                                    <thead>
                                    <tr>
                                        <th><span class="sort">дата</span></th>
                                        <th><span class="sort">статус</span></th>
                                        <th>отчисления</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($arItems as $obOrder){?>
                                        <tr>
                                            <td><?=date('d.m.Y', strtotime($obOrder->date))?></td>
                                            <td><?=$obOrder->status->name?></td>
                                            <td><?=number_format((isset($transactions[$obOrder->id]) ? $transactions[$obOrder->id] : '0'), 2, ',', ' ')?></td>
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
                        <p>Еще никто не оформил заказ по Вашему промокоду.</p>
                    <?php } ?>
                </div>
            </article>
        </div>
    </div>
</div>