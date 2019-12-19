<?php

use app\models\Invoice;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Счета';
$this->params['breadcrumbs'][] = $this->title;

$selectedStatus = \Yii::$app->request->get('status');

?>
<div class="news-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <form>

        <label for="created">Дата создания</label>
        <?= \nex\datepicker\DatePicker::widget([
            'name'  => 'created',
            'value'  => Yii::$app->request->get('created'),
            'placeholder' => 'Дата создания',
            'language' => 'ru'
        ]) ?>
        <label for="closed">Дата закрытия</label>
        <?= \nex\datepicker\DatePicker::widget([
            'name'  => 'closed',
            'value'  => Yii::$app->request->get('closed'),
            'placeholder' => 'Дата закрытия',
            'language' => 'ru'
        ]) ?>

        <label for="status">Статус</label>
        <select class="form-control" name="status" id="status">
            <option <?= ($selectedStatus == '0') ? 'selected=""' : '' ?> value="0"></option>
            <?php foreach(Invoice::getStatusList() as $status => $statusText){ ?>
                <option <?= ($selectedStatus == $status) ? 'selected=""' : '' ?> value="<?=$status?>"><?=$statusText?></option>
            <?php } ?>
        </select><br>
        <input type="submit" class="btn btn-success" value="Фильтровать"/>
    </form>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
          //  ['class' => 'yii\grid\SerialColumn'],

            'id',
            'created',
            'closed',
            'expired',
            'sum',
            'statusText',
            ['class' => 'yii\grid\ActionColumn', 'template' => "{view}"],
        ],
    ]) ?>
</div>
