<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var \app\models\OrderStatus[] $arStatuses */

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;

$selectedStatusId = \Yii::$app->request->get('status_id');
?>
<div class="news-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <form>

        <?= \nex\datepicker\DatePicker::widget([
            'name'  => 'from_date',
            'value'  => '',
            'placeholder' => 'Фильтр по дате',
            'language' => 'ru'
        ]);?>

        <label for="status_id">Статус</label>
        <select class="form-control" name="status_id" id="status_id">
            <option value=""></option>
            <?php foreach($arStatuses as $obStatus){ ?>
                <option <?= ($selectedStatusId === $obStatus->id) ? 'selected="selected"' : '' ?> value="<?=$obStatus->id?>"><?=$obStatus->name?></option>
            <?php } ?>
        </select><br>
        <input type="submit" class="btn btn-success" value="Фильтровать"/>
    </form>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'createDate',
            'fio',
            'phone',
            'email',
            'address',
            'sum',
            'status.name',
            [
                'content' => function($data) {
                    /* @var \app\models\Discount $discount */
                    $discount = $data->discount_id ? $data->getDiscount()->one() : null;
                    return $discount ? Html::a($discount->code, Url::to(["discount/view", "id" => $discount->id])) : '-';
                },
                'header' => 'Промо-код'
            ],
            ['class' => 'yii\grid\ActionColumn', 'template' => $viewOnly ? '{view}' : "{view}{update}"],
        ],
    ]); ?>
</div>
