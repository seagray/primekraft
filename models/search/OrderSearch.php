<?php

namespace app\models\search;

use app\models\Order;
use yii\data\ActiveDataProvider;


class OrderSearch extends Order
{

    public static function search($arAttributes = [], $arOrder = ['id'=> SORT_DESC], $nPageSize = 10, $arSelect = [])
    {
        $obModel = new Order();
        $obQuery = Order::find();

        if(!empty($arSelect))
            $obQuery->select($arSelect);

        $obQuery->joinWith(['status','discount'])->groupBy(['orders.id']);

        $obData = new ActiveDataProvider([
            'query'=>$obQuery,
            'sort' => ['defaultOrder'=>$arOrder],
            'pagination'=>['pageSize'=>$nPageSize]
        ]);

        foreach ($obModel->attributes as $name => $value)
            if (isset($arAttributes[$name]) && !empty($arAttributes[$name]))
                $obModel->$name = $arAttributes[$name];
        if (isset($arAttributes['user_id']) && !empty($arAttributes['user_id']))
            $obQuery->andWhere(['discount.user_id' => $arAttributes['user_id']]);
        if (isset($arAttributes['date_from']) && !empty($arAttributes['date_from']))
            $obQuery->andWhere('orders.date >= :date_from', [':date_from' => date('Y-m-d 00:00:00', strtotime($arAttributes['date_from']))]);
        if (isset($arAttributes['date_to']) && !empty($arAttributes['date_to']))
            $obQuery->andWhere('orders.date <= :date_to', [':date_to' => date('Y-m-d 23:59:59', strtotime($arAttributes['date_to']))]);

        return $obData;
    }
}