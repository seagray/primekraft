<?php
/**
 * @var array $referrals
 * @var \yii\data\Pagination $pagination
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
                    <h1>Рефералы</h1>
                <?php } ?>
                <div class="personalInfo">
                    <?php if (!empty($referrals)) { ?>
                        <div class="lk_table">
                            <table>
                                <thead>
                                    <tr>
                                        <th><span class="sort">имя</span></th>
                                        <th>заработано на реферале</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach($referrals as $referral){?>
                                    <tr>
                                        <td><?=$referral['user']->nickname?></td>
                                        <td><?=number_format($referral['sum'], 2, ',', ' ')?></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                            <?echo \yii\widgets\LinkPager::widget([
                                'pagination' => $pagination,
                            ]);?>
                        </div>
                    <?php } else { ?>
                        <p>У вас пока нет рефералов. Отправьте личную промо-ссылку своим друзьям, пусть они зарегистрируются на сайте!</p>
                    <?php } ?>
                </div>
            </article>
        </div>
    </div>
</div>