<?php
namespace app\components;

use app\models\Discount;
use app\models\Invoice;
use app\models\Order;
use app\models\OrderContent;
use app\models\OrderStatus;
use app\models\Product;
use yii\base\ErrorException;
use  yii\web\Session;

class Card
{
    private $arItems = [],
        $arFields = [],
        $nDiscount = 0;

    public function __construct()
    {
        $session = new Session;
        $session->open();
        $this->arItems = \Yii::$app->session['card'];
        $this->arFields = \Yii::$app->session['order_fields'];
    }

    /**
     * Добавление/изменение кол-ва продукта
     * @param $nId
     * @param $nCount
     * @param bool $bChange
     * @return bool
     * @throws \yii\base\ErrorException
     */
    public function saveItem($nId, $nCount, $bChange = false)
    {

        $obProduct = Product::findOne($nId);

        if (empty($obProduct)) {
            throw new ErrorException('Продукт не существует!');
        }

        if ($nCount <= 0 && $bChange == true) {
            $this->removeItem($nId);
            return false;
        }

        $arItem = [];

        if (!empty($this->arItems[$nId])) {

            $nResult = intval($this->arItems[$nId]['count']) + intval($nCount);

            if ($bChange) {
                $nResult = intval($nCount);
            }

            $nCount = $nResult;
        } else {
            $nCount = intval($nCount);
        }

        if ($nCount < 0) {
            $this->removeItem($nId);
            return true;
        }

        $arItem['count'] = $nCount;
        $arItem['name'] = $obProduct->getDisplayName();
        $arItem['price'] = $obProduct->price;

        if (!empty($arItem)) {
            $this->arItems[$nId] = $arItem;
        }
    }

    /**
     * Удаление продукта из корзины
     * @param $nId
     */
    public function removeItem($nId)
    {

        if (!empty($this->arItems[$nId])) {
            unset($this->arItems[$nId]);
        }
    }

    /**
     * Список имеющихся продуктов в корзине
     * @return array
     */
    public function getItems()
    {

        if (!empty($this->arItems)) {
            return $this->arItems;
        }

        return [];
    }

    /**
     * Возвращает кол-во элементов в корзине
     * @return int
     */
    public function getItemsCount()
    {

        $nCount = 0;

        if (!empty($this->arItems)) {
            foreach ($this->arItems as $arItem) {
                $nCount = $nCount + $arItem['count'];
            }
        }
        return $nCount;
    }

    /**
     * Получение данных формы
     * @return array
     */
    public function getFields()
    {
        return $this->arFields;
    }

    public function getField($field)
    {
        return isset($this->arFields[$field]) ? $this->arFields[$field] : null;
    }

    /**
     * Запись поля
     * @param $sName
     * @param $sValue
     */
    public function setField($sName, $sValue)
    {
        $this->arFields[$sName] = $sValue;
    }

    /**
     * Общая сумма в корзине
     * @return int
     */
    public function getTotal()
    {

        $arValues = [];
        $nResult = 0;
        $this->nDiscount = 0;

        if (!empty($this->arItems)) {
            foreach ($this->arItems as $nId => $arItem) {
                $this->arItems[$nId]['discount'] = 0;
            }
        }

        if (!empty($this->arFields['code'])) {
            $obCode = Discount::find()->joinWith(['values'])->where(['code' => $this->arFields['code']])->one();
            if (!empty($obCode)) {

                $bSuccess = true;

                if (empty($obCode->user_id) && strtotime($obCode->lifetime) < time()) {
                    $bSuccess = false;
                }

                if ($bSuccess && !empty($obCode->values)) {
                    $arVals = $obCode->values;

                    foreach ($arVals as $obValue) {
                        $arValues[$obValue->product_id] = $obValue->percent;
                    }
                }
            }
        }

        if (!empty($this->arItems)) {
            foreach ($this->arItems as $nId => $arItem) {
                $nPrice = intval($arItem['price']) * intval($arItem['count']);
                $nResult = $nResult + $nPrice;

                if (!empty($arValues[$nId])) {
                    $nDiscount = intval($this->getPercent($nPrice, $arValues[$nId]));
                    $this->arItems[$nId]['discount'] = $nDiscount;
                    $this->nDiscount = $this->nDiscount + $nDiscount;
                }
            }
        }

        return ceil($nResult - $this->nDiscount);
    }

    /**
     * Получение процента от числа
     * @param $nSum
     * @param $nPercent
     * @return float
     */
    public static function getPercent($nSum, $nPercent)
    {
        if ($nPercent > 100) {
            // параметр скидки > 100%, скидка не может быть больше стоимости
            return $nSum;
        }
        return $nSum * $nPercent / 100;
    }

    public function getWeight()
    {
        $weight = 0;
        $items = $this->getItems();
        foreach ($items as $id => $item) {
            if ($product = Product::findOne($id)) {
                $weight += $item["count"] * Product::findOne($id)->weight;
            }
        }
        return $weight;
    }

    /**
     * Получение скидки
     * @return int
     */
    public function getDiscount()
    {

        $this->nDiscount = 0;

        if (!empty($this->arItems)) {
            foreach ($this->arItems as $arItem) {
                $this->nDiscount = $this->nDiscount + $arItem['discount'];
            }
        }

        return $this->nDiscount;
    }

    /**
     * Получение суммы без скидки
     */
    public function getSum()
    {
        return $this->getTotal() + $this->nDiscount;
    }


    /**
     * Очистка корзины
     * @return bool
     */
    public function clear()
    {
        $this->arItems = [];
        return true;
    }


    /**
     * Формирование заказа
     * @return bool | Order
     */
    public function addOrder()
    {

        $obOrder = new Order();

        if (!empty($this->arFields['name'])) {
            $obOrder->fio = $this->arFields['name'];
        }

        if (!empty($this->arFields['phone'])) {
            $obOrder->phone = $this->arFields['phone'];
        }

        if (!empty($this->arFields['email'])) {
            $obOrder->email = $this->arFields['email'];
        }

        if (!empty($this->arFields['email'])) {
            $obOrder->address = $this->arFields['address'];
        }

        if (!empty($this->arFields['description'])) {
            $obOrder->comment = $this->arFields['description'];
        }

        $statusNew = OrderStatus::findOne(['code' => OrderStatus::STATUS_CODE_NEW]);
        $obOrder->status_id = $statusNew->id;

        $obOrder->sum = $this->getTotal();
        $obOrder->discount = $this->getDiscount();

        $obOrder->delivery_cost = $this->getField("delivery_price");
        $obOrder->payment_on_delivery = $this->getField("pay_on_delivery");

        if (!empty($this->arFields['code'])) {
            $obCode = Discount::find()->where(['code' => $this->arFields['code']])->one();

            if (!empty($obCode)) {

                if (!empty($obCode->user_id)) {
                    $obOrder->discount_id = $obCode->id;
                    $obCode->is_order = 1;
                } else {
                    if ($obCode->lifetime != null || strtotime($obCode->lifetime) > time()) {
                        $obOrder->discount_id = $obCode->id;
                        $obCode->is_order = 1;
                    }
                }
                $obCode->save();
            }
        }

        $obOrder->date = date('Y-m-d H:i:s');

        $invoice = new Invoice();
        $invoice->created = $obOrder->date;
        $invoice->expires = \Yii::$app->params["invoice"]['expires'];
        $invoice->status = Invoice::STATUS_OPENED;
        $invoice->sum = $obOrder->sum + $obOrder->delivery_cost;
        $invoice->save();

        $obOrder->invoice_id = $invoice->id;

        if (!$obOrder->save()) {
            \Yii::$app->session->setFlash("order", \yii\helpers\Html::errorSummary($obOrder));
            return false;
        }

        foreach ($this->arItems as $nId => $arItem) {
            $obItem = new OrderContent();
            $obItem->order_id = $obOrder->id;
            $obItem->product_id = $nId;
            $nPrice = $arItem['price'] * $arItem['count'];

            if (!empty($arItem['discount'])) {
                $nDiscount = $nPrice - $arItem['discount'];
                $obItem->price_discount = $nDiscount;
            }

            $obItem->count = $arItem['count'];
            $obItem->price = $nPrice;
            $obItem->save();
        }
        Email::notify('order/customer', ['order' => $obOrder]);
        if ($obOrder->payment_on_delivery) {
            Email::notify('order/manager', ['order' => $obOrder]);
        }

        return $obOrder;
    }

    public function destroy()
    {
        unset($this->arFields);
        unset($this->arItems);
    }

    /**
     * При завершении хита все актуальные продукты пишутся в сессию
     */
    public function __destruct()
    {
        \Yii::$app->session['card'] = $this->arItems;
        \Yii::$app->session['order_fields'] = $this->arFields;
    }
}