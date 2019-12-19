<?php

namespace app\controllers;

use app\components\BaseController;
use app\models\Address;
use app\models\City;
use app\models\Team;
use yii;

/**
 * Class ContentController
 * @package app\controllers
 */
class ContentController extends BaseController
{
    public function actionAddresses()
    {
        $result = [];
        $params = ['public' => 1];
        if (Yii::$app->request->get('city')) {
            $params['city_id'] = Yii::$app->request->get('city');
        }

        foreach (Address::findAll($params) as $addr){
            $result[] = [
                'name' => $addr->name,
                'description' => $addr->description,
                'address' => $addr->address,
                'phone' => $addr->phones,
                'website' => $addr->website,
                'url' => parse_url($addr->website),
                'latitude' => $addr->latitude,
                'longitude' => $addr->longitude
            ];
        }
        echo json_encode($result);
    }

    public function actionCityObjects()
    {
        $result = [];
        foreach (City::findAll(['public' => 1]) as $city){
            $el = [
                'name' => $city->name,
                'id' => $city->id,
                'latitude' => $city->latitude,
                'longitude' => $city->longitude,
                'districts' => [],
                'subways' => []
            ];

            foreach ($city->getDistricts() as $district) {
                $el['districts'][] = [
                    'name' => $district->name,
                    'id' => $city->id,
                    'latitude' => $district->latitude,
                    'longitude' => $district->longitude,
                ];
            }

            foreach ($city->getSubways() as $subway) {
                $el['subways'][] = [
                    'name' => $subway->name,
                    'id' => $city->id,
                    'latitude' => $subway->latitude,
                    'longitude' => $subway->longitude,
                ];
            }
            $result[] = $el;
        }
        echo json_encode($result);
    }
}
