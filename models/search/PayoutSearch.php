<?php

namespace app\models\search;

use app\models\Payout;
use yii\data\ActiveDataProvider;


class PayoutSearch extends Payout
{

    public static function search($arAttributes = [], $arOrder = ['id' => SORT_DESC], $nPageSize = 10, $arSelect = [])
    {
        $obModel = new static();
        $obQuery = static::find();

        if (!empty($arSelect)) {
            $obQuery->select($arSelect);
        }

        $obData = new ActiveDataProvider([
            'query' => $obQuery,
            'sort' => ['defaultOrder' => $arOrder],
            'pagination' => ['pageSize' => $nPageSize]
        ]);

        foreach ($obModel->attributes as $name => $value) {
            if (isset($arAttributes[$name]) && !empty($arAttributes[$name])) {
                $obModel->$name = $arAttributes[$name];
            }
        }
        if (isset($arAttributes['user_id']) && !empty($arAttributes['user_id'])) {
            $obQuery->andWhere(['user_id' => $arAttributes['user_id']]);
        }
        if (isset($arAttributes['date_from']) && !empty($arAttributes['date_from'])) {
            $obQuery->andWhere('date >= :date_from', [':date_from' => $arAttributes['date_from']]);
        }
        if (isset($arAttributes['date_to']) && !empty($arAttributes['date_to'])) {
            $obQuery->andWhere('date <= :date_to', [':date_to' => date('Y-m-d 23:59:59', strtotime($arAttributes['date_to']))]);
        }

        return $obData;
    }
}