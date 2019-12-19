<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        
    </head>
    <body>
        <?php $this->beginBody() ?>

        <div class="wrap">
            <div class="container">
                <?php if (\Yii::$app->user->can('admin')) { ?>
                    <?=$this->renderFile('@app/modules/admin/views/layouts/inc/admin_menu.php'); ?>
                <?php } else if (\Yii::$app->user->can('partner_manager')) { ?>
                    <?=$this->renderFile('@app/modules/admin/views/layouts/inc/pm_menu.php'); ?>
                <?php } ?>
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    'homeLink' => ['label' => 'Администрирование', 'url' => ['/admin']],
                ]) ?>
                <?= $content ?>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; Storverk <?= date('Y') ?></p>

                <p class="pull-right"><?= Yii::powered() ?></p>
            </div>
        </footer>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
