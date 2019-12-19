<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Промокоды';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (!$viewOnly) { ?>
        <p><?= Html::a('Добавить скидку', ['create'], ['class' => 'btn btn-success']) ?></p>
    <?php } ?>

    <form>
        <label>Партнер</label>
        <select class="form-control" name="user_id">
            <?php foreach($arUsers as $obUser){ ?>
            <option <?= (Yii::$app->request->get('user_id') == $obUser->id) ? 'selected' : '' ?> value="<?=$obUser->id?>"><?=$obUser->username?></option>
            <?php } ?>
        </select><br>
        <input type="submit" class="btn btn-success" value="Фильтровать"/>
    </form>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'code',
            'lifetime',
            'cookie_expire',
            'user.username',
            ['class' => 'yii\grid\ActionColumn', 'template' => $viewOnly ? '{view}' : '{update}{delete}'],
        ],
    ]); ?>
</div>
