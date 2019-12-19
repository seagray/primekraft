<?php
/**
 * @var \app\models\Vacancy $model
 */


use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Заявки на регистрацию', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if ($user = $model->getUser()) { ?>
            <?php if (\Yii::$app->user->can('admin')) { ?>
                <?= Html::a('Карточка партнера', ['user/view', 'id' => $user->id], [
                    'class' => 'btn btn-primary',
                ]) ?>
            <?php } ?>
        <?php } ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'phone',
            'email',
            'vk_profile',
            'instagram_profile',
            'dt',
        ],
    ]) ?>

</div>
