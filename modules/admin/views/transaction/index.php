<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Начисления';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <form>

        <label>Дата с</label>
        <?= \nex\datepicker\DatePicker::widget([
            'name'  => 'date_from',
            'value'  => $dateFrom,
            'language' => 'ru'
        ]);?>

        <label>Дата по</label>
        <?= \nex\datepicker\DatePicker::widget([
            'name'  => 'date_to',
            'value'  => $dateTo,
            'language' => 'ru'
        ]);?>

        <label>Партнер</label>
        <select class="form-control" name="user_id">
            <option value=""></option>
            <?php foreach($users as $obUser){?>
                <option <?= ($userId == $obUser->id) ? 'selected="selected"' : '' ?> value="<?=$obUser->id;?>"><?=$obUser->username;?></option>
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
            'sum',
            'date',
            'order_id'
        ],
    ]); ?>
</div>
