<?php
/**
 * @var \yii\web\View $this
 */
use yii\helpers\Url;

?>

<div class="lk_radio--group">
    <label onclick="window.location='<?=Url::to('/', true).\Yii::$app->getRequest()->getPathInfo()?>'">
        <input type="radio" class="all-time" name="time"<?php if (empty($params['date_from']) && empty($params['date_to'])) {?> checked="checked"<?php } ?> />
        <span></span>
        <span class="lk_radio--text">за все время</span>
    </label>
    <label>
        <input type="radio" class="period-time" name="time"<?php if (!empty($params['date_from']) || !empty($params['date_to'])) {?> checked="checked"<?php } ?> />
        <span></span>
        <span class="lk_radio--text">за период</span>
    </label>
</div>
<div class="period">
    <form method="get">
        <input type="text" name="from" value="<?=$params['date_from']?>" placeholder="">
        <span>—</span>
        <input type="text" name="to" value="<?=$params['date_to']?>" placeholder="">
        <div class="button_link--default">
            <button type="submit" class="button_link js-submit"><span>применить</span><i></i></button>
        </div>
    </form>
</div>