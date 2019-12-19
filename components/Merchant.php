<?php

namespace app\components;

class Merchant extends \robokassa\Merchant
{

    public function getUrl($nOutSum, $nInvId, $sInvDesc = null, $sIncCurrLabel=null, $sEmail = null, $sCulture = null, $shp = [], $useTest = false)
    {
        $url = $this->baseUrl;

        $signature = "{$this->sMerchantLogin}:{$nOutSum}:{$nInvId}:{$this->sMerchantPass1}";
        if (!empty($shp)) {
            $signature .= ':' . $this->implodeShp($shp);
        }
        $sSignatureValue = md5($signature);

        $params = [
            'MerchantLogin' => $this->sMerchantLogin,
            'OutSum' => $nOutSum,
            'InvoiceID' => $nInvId,
            'Desc' => $sInvDesc,
            'SignatureValue' => $sSignatureValue,
            'IncCurrLabel' => $sIncCurrLabel,
            'Email' => $sEmail,
            'Culture' => $sCulture
        ];
        if ($useTest) {
            $params['IsTest'] = '1';
        }

        $url .= '?' . http_build_query($params);

        if (!empty($shp) && ($query = http_build_query($shp)) !== '') {
            $url .= '&' . $query;
        }

        return $url;
    }

    public function payment($nOutSum, $nInvId, $sInvDesc = null, $sIncCurrLabel=null, $sEmail = null, $sCulture = null, $shp = [], $useTest = false)
    {
        $url = $this->getUrl($nOutSum, $nInvId, $sInvDesc, $sIncCurrLabel, $sEmail, $sCulture, $shp, $useTest);

        \Yii::$app->user->setReturnUrl(\Yii::$app->request->getUrl());
        return \Yii::$app->response->redirect($url);
    }

    private function implodeShp($shp)
    {
        ksort($shp);
        foreach($shp as $key => $value) {
            $shp[$key] = $key . '=' . $value;
        }

        return implode(':', $shp);
    }
}