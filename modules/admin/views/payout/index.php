<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Выплаты';
$this->params['breadcrumbs'][] = $this->title;

$selectedStatusId = \Yii::$app->request->get('status_id');
?>
<div class="news-index">

    <form>

        <label>Дата с</label>
        <?= \nex\datepicker\DatePicker::widget([
            'name'  => 'from_date',
            'value'  => '',
            'language' => 'ru'
        ]);?>

        <label>Дата по</label>
        <?= \nex\datepicker\DatePicker::widget([
            'name'  => 'from_date',
            'value'  => '',
            'language' => 'ru'
        ]);?>

        <label>Статус</label>
        <select class="form-control" name="status_id">
                <option <?= $selectedStatusId == 0 ? 'selected="selected"' : ''?> value="0"><?=\app\models\Payout::findStatusText(0)?></option>
                <option <?= $selectedStatusId == 1 ? 'selected="selected"' : ''?> value="1"><?=\app\models\Payout::findStatusText(1)?></option>
                <option <?= $selectedStatusId == 2 ? 'selected="selected"' : ''?> value="2"><?=\app\models\Payout::findStatusText(2)?></option>
        </select><br>

        <label>Партнер</label>
        <select class="form-control" name="user_id">
            <option value=""></option>
            <?php foreach($users as $obUser){?>
                <option <?= (\Yii::$app->request->get('user_id') == $obUser->id) ? 'selected=""' : ''?> value="<?=$obUser->id?>"><?=$obUser->username?></option>
            <?php } ?>
        </select><br>
        <input type="submit" class="btn btn-success" value="Фильтровать"/>
    </form>


    <h1><?= Html::encode($this->title) ?></h1>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user.username',
            [
                'attribute' => 'statusText',
                'label' => 'Статус'
            ],
            'sum',
            'date',
            ['class' => 'yii\grid\ActionColumn', 'template' => $viewOnly ? '{view}' : '{view} {update}'],
        ],
    ]); ?>
</div>
