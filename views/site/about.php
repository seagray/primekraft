<div class='wrapper'><!-- Боковая навигация и контентная часть -->
    <div class="group">
        <article class="content"><!-- Контент -->
            <?=\app\models\Content::text('about_1_part')?>
        </article>
    </div>
</div>
<!-- Блок с сертификатами -->
<div class="colorBlock sert">
    <div class='wrapper'>
        <div class="lefter col-md-3 col-sm-3 col-xs-12">
            <div class="sert_img">
                <img src="<?=Yii::getAlias('@web/img/sert_1.png')?>" alt="">
                <img src="<?=Yii::getAlias('@web/img/sert_2.png')?>" alt="">
            </div>
        </div>
        <div class="righter col-md-9 col-sm-9 col-xs-12">
            <?=\app\models\Content::text('about_2_part')?>
        </div>
    </div>
</div>
<!-- Блок с сертификатами END -->
<div class='wrapper'>
    <div class='group'>
        <article class="content">
            <?=\app\models\Content::text('about_3_part')?>
        </article><!-- Контент END -->
    </div>
</div><!-- Боковая навигация и контентная часть END -->