<?php
/**
 * @var \yii\web\View $this ?>
 */
?>
<div class="admin-default-index">
    <?php
    if (isset($_GET['live_edit'])) {
        if (!$_GET['live_edit']) {
            unset($_SESSION['live_edit']);
        } else {
            $_SESSION['live_edit'] = true;
        }
    }
    ?>
    <?php if (\Yii::$app->user->can('admin')) { ?>
        <?php if (!isset($_SESSION['live_edit'])) { ?>
            <a href="?live_edit=1">Включить live edit</a>
        <?php }else{ ?>
            <a href="?live_edit=0">Выключить live edit</a>
        <?php } ?>
    <?php } ?>
</div>
