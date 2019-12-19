<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'username',
            'nickname',
            'email:email',
            // 'confirmed_at',
            // 'unconfirmed_email:email',
            // 'blocked_at',
            // 'registration_ip',
            // 'created_at',
            // 'updated_at',
            // 'flags',
             'roleTitle' => [
                 "label" => "Роль",
                 "value" => "roleTitle"
             ],
//             'hold',
//             'pay',
//             'payout',
//             'is_code',
            [
                'content' => function($data) {
                    /* @var \app\models\Discount $discount */
                    $discount = $data->getDiscount();
                    return $discount ? Html::a(!empty($discount->code) ? $discount->code : '-' , \yii\helpers\Url::to(["discount/view", "id" => $discount->id])) : '-';
                },
                'header' => 'Промо-код'
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
