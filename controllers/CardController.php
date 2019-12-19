<?php

namespace app\controllers;

use app\components\BaseController;
use app\components\Card;
use app\models\Discount;
use app\models\Product;
use app\components\Merchant;
use yii;
use yii\validators\EmailValidator;
use yii\validators\StringValidator;
use yii\validators\NumberValidator;
use yii\validators\ExistValidator;


class CardController extends BaseController
{
    public function init()
    {
        Yii::$app->params['current_page'] = 'cart';
    }

    /**
     * страница корзины
     * @return string
     */
    public function actionIndex()
    {
        $obCard = new Card();
        $items = $obCard->getItems();
        foreach ($items as $id => &$item) {
            $item['object'] = Product::findOne($id);
        }

        $promoCode = Discount::getPromo();
        if ($promoCode !== false) {
            $obCard->setField('code', $promoCode);
        }

        return $this->render('index', [
            'cartCount' => $obCard->getItemsCount(),
            'arItems' => $items,
            'nTotal' => $obCard->getTotal(),
            'nSum' => $obCard->getSum(),
            'nDiscount' => $obCard->getDiscount(),
            'arFields' => $obCard->getFields(),
            'promoCode' => $promoCode
        ]);
    }


    /**
     * Получение попапа корзины
     * @return string
     */
    public function actionGet()
    {

        $obCard = new Card();

        return $this->renderAjax('ajax',
            [
                'total' => $obCard->getTotal(),
                'sum' => $obCard->getSum(),
                'count' => $obCard->getItemsCount(),
                'items' => $obCard->getItems()
            ]
        );
    }

    /**
     * данные корзины
     */
    public function actionData()
    {
        $obCard = new Card();
        echo json_encode(
            [
                'count' => $obCard->getItemsCount(),
                'total' => $obCard->getTotal(),
                'sum' => $obCard->getSum(),
                'discount' => $obCard->getDiscount(),
                'items' => $obCard->getItems()
            ]
        );
    }

    /**
     * Добавление продукта в корзину
     */
    public function actionAdd()
    {
        $arGet = Yii::$app->request->get();

        $obCard = new Card();
        $obCard->saveItem($arGet['id'], $arGet['count']);

        echo json_encode([
            'items' => $obCard->getItems(),
            'total' => $obCard->getTotal(),
            'discount' => $obCard->getDiscount(),
            'sum' => $obCard->getTotal() + $obCard->getDiscount()
        ]);
        exit;
    }

    /**
     * Получение результирующей суммы заказа
     */
    public function actionGetSum()
    {
        $obCard = new Card();

        echo json_encode([
            'total' => $obCard->getTotal(),
            'discount' => $obCard->getDiscount(),
            'sum' => $obCard->getTotal() + $obCard->getDiscount()
        ]);
        exit;
    }

    /**
     * изменение продукта в корзине
     */
    public function actionChange()
    {
        $arGet = Yii::$app->request->get();

        $obCard = new Card();
        $obCard->saveItem($arGet['id'], $arGet['count'], true);

        echo json_encode([
            'items' => $obCard->getItems(),
            'total' => $obCard->getTotal(),
            'discount' => $obCard->getDiscount(),
            'sum' => $obCard->getTotal() + $obCard->getDiscount()
        ]);
        exit;
    }

    /**
     * Удаление продукта из корзины
     */
    public function actionRemove()
    {
        $arGet = Yii::$app->request->get();

        $obCard = new Card();
        $obCard->removeItem($arGet['id']);

        echo json_encode([
            'items' => $obCard->getItems(),
            'total' => $obCard->getTotal(),
            'discount' => $obCard->getDiscount(),
            'sum' => $obCard->getTotal() + $obCard->getDiscount()
        ]);
        exit;
    }

    /**
     * Очистка корзины
     */
    public function actionClear()
    {
        $obCard = new Card();

        echo json_encode(['success' => $obCard->clear()]);
        exit;
    }


    /**
     * Запись введенного поля в сессию
     */
    public function actionAddField()
    {
        $fields = [
            'name' => StringValidator::class,
            'phone' => StringValidator::class,
            'address' => StringValidator::class,
            'city' => StringValidator::class,
            'email' => EmailValidator::class,
            'sign' => NumberValidator::class,
            'pay_on_delivery' => NumberValidator::class,
            'description' => StringValidator::class,
            'code' => [ExistValidator::class, ['targetClass' => Discount::class, 'targetAttribute' => 'code']],
        ];

        $safe = ["sign", "pay_on_delivery"];

        $field = Yii::$app->request->post('name');
        $val = Yii::$app->request->post('value');
        if ($field == 'code') {
            $val = mb_strtoupper($val);
        }
        $error = false;

        if (!isset($fields[$field])) {
            $error = 'undefined field';
        }

        if (!$error && !in_array($field, $safe) && empty($val)) {
            $error = 'Пустое значение';
        }

        $obOrder = new Card();

        if (!$error) {
            $class = is_array($fields[$field]) ? $fields[$field][0] : $fields[$field];
            $params = is_array($fields[$field]) ? $fields[$field][1] : [];

            /**
             * @var $validator yii\validators\Validator
             */

            $validator = new $class($params);
            if ($validator->validate($val, $error)) {
                if ($field == 'code') {
                    $discount = Discount::findOne(['code' => $val]);
                    if ($discount->lifetime == null || strtotime($discount->lifetime) > time()) {
                        $obOrder->setField($field, $val);
                    } else {
                        $error = 'Промо-кода не существует или его срок действия истек';
                        $obOrder->setField($field, '');
                    }
                } else {
                    $obOrder->setField($field, $val);
                }
                if ($field == 'address') {
                    $old_addr = $obOrder->getField("address");
                    // Если включить правило, то будет баг
                    if (1 || $old_addr != $val) {
                        $postalCode = null;
                        $courierDelivery = false;
                        $deliveryPrice = null;
                        $url = 'https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($val);
                        $opts = array(
                            'http'=>array(
                                'method'=>"GET",
                                'header'=>"Accept-language: ru\r\n"
                            )
                        );
                        $context = stream_context_create($opts);

                        $addr = json_decode(file_get_contents($url, false, $context), 1);
                        $addr = $addr['results'][0];

                        $city = '';
                        foreach ($addr['address_components'] as $part) {
                            if ($part['types'][0] == "postal_code") {
                                $postalCode = $part["long_name"];
                            }

                            if ($part["types"][0] == "locality" && (in_array($part["long_name"], [
                                    "Санкт-Петербург",
                                    "Москва"
                                ]))) {
                                $city = $part["long_name"];
                                $courierDelivery = true;
                            }
                        }
                        if ($postalCode) {
                            if ($obOrder->getTotal() >= Yii::$app->params["delivery"]["free"]['capital'] && $courierDelivery ||
                                $obOrder->getTotal() >= Yii::$app->params["delivery"]["free"]['regions'] && !$courierDelivery) {
                                // Бесплатная доставка
                                $deliveryPrice = 0;
                            } else {
                                if ($courierDelivery) {
                                    $fullWeight = Yii::$app->params["deliveryCourier"]["packagingWeight"] + $obOrder->getWeight();

                                    $deliveryPrice = 0;
                                    foreach (Yii::$app->params["deliveryCourier"]["tariff"][$city] as $tariff) {
                                        if ($tariff[0] <= $fullWeight && $tariff[1] > $fullWeight) {
                                            $deliveryPrice = $tariff[2];
                                        }
                                    }
                                } else {
                                    if (!$deliveryPrice = $this->calculateDelivery($postalCode,
                                        Yii::$app->params["postalSettings"]["packagingWeight"] + $obOrder->getWeight())
                                    ) {
                                        $deliveryPrice = Yii::$app->params["postalSettings"]["defaultPrice"];
                                    }
                                }
                            }
                        } else {
                            if ($obOrder->getTotal() >= Yii::$app->params["delivery"]["free"]['capital'] && $courierDelivery ||
                                $obOrder->getTotal() >= Yii::$app->params["delivery"]["free"]['regions'] && !$courierDelivery) {
                                // Бесплатная доставка
                                $deliveryPrice = 0;
                            } else {
                                $deliveryPrice = Yii::$app->params["postalSettings"]["defaultPrice"];
                            }
                        }
                        $obOrder->setField('postalCode', $postalCode);
                        $obOrder->setField('delivery_price', $deliveryPrice);
                        $obOrder->setField('can_payment_on_delivery', $courierDelivery);
                    }
                }
            } else {
                $obOrder->setField($field, '');
            }
        }
        echo json_encode(array_merge([
            'success' => !(boolean)$error,
            'errors' => [
                $field => [$error]
            ]
        ], $this->getInfo()));
    }

    private function getDeliveryPrice()
    {
        $cart = new Card();
     /*   if ($cart->getField('pay_on_delivery')) {
            return Yii::$app->params["deliveryCourier"];
        }*/
        return $cart->getField("delivery_price");
    }

    public function getInfo()
    {
        $cart = new Card();
        return [
            "delivery" => [
                "price" => $this->getDeliveryPrice(),
                "can_payment_on_delivery" => $cart->getField("can_payment_on_delivery")
            ],
//            "info" => $cart->getFields()
        ];
    }

    public function actionInfo()
    {
        echo json_encode($this->getInfo());
    }


    /**
     * оформление заказа
     * @return string|yii\web\Response
     */
    public function actionOrder()
    {
        $obOrder = new Card();
        if ($obOrder->getItemsCount() > 0) {
            $obResult = $obOrder->addOrder();
            if ($obResult == false) {
                return $this->redirect(yii\helpers\Url::to(['index']));
            }
            $pay_on_delivery = $obOrder->getField('pay_on_delivery');
            $obOrder->destroy();

            if (!$pay_on_delivery) {
                $merch = new Merchant(Yii::$app->params["robokassa"]);
                return $merch->payment($obResult->sum + $obResult->delivery_cost, $obResult->invoice_id, "Оплата заказа №" . $obResult->id . " на сайте primekraft.ru", null, $obResult->email);
            }
        } else {
            return $this->redirect(yii\helpers\Url::to(['/production']));
        }
        return $this->render('success', ['order' => $obResult]);
    }

    /**
     * @deprecated
     * @return string
     */
    public function actionOrderSuccess()
    {
        return $this->render('success');
    }

    private function calculateDelivery($zipCodeTo, $weight)
    {
        $data = [
            "costCalculationEntity" => [
                "parcelKind" => "STANDARD",
                "postingCategory" => "ORDINARY",
                "postingKind" => "PARCEL",
                "postingType" => "VPO",
                "wayForward" => "EARTH",
                "weightRange" => [$weight],
                "zipCodeFrom" => Yii::$app->params["postalSettings"]["zipCodeFrom"],
                "zipCodeTo" => (string)$zipCodeTo
            ],
        ];

        $data_json = json_encode($data);
        $ch = curl_init("https://www.pochta.ru/portal-portlet/delegate/calculator/v1/api/delivery.time.cost.get");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_json))
        );

        $result = curl_exec($ch);
        $result = json_decode($result, 1);

        $price = ceil($result['data']['costEntity']['cost']/10)*10;

        return $price;
    }
}
