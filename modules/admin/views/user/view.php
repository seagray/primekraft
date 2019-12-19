<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Удалить пользователя?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
            'username',
            'nickname',
            'email:email',
//            'password_hash',
//            'auth_key',
//            'confirmed_at',
//            'unconfirmed_email:email',
//            'blocked_at',
//            'registration_ip',
//            'created_at',
//            'updated_at',
//            'flags',
            'role',
            [
                'attribute' => 'referrer.nickname',
                'label' => 'Реферрер'
            ],
            'hold',
            'pay',
            'payout',
//            'is_code',
        ],
    ]) ?>

</div>
