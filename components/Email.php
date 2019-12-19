<?php
namespace app\components;

use app\models\User;

class Email
{
    private $mailer;
    public function __construct($view = null, $params = [])
    {
        $this->mailer = \Yii::$app->mailer->compose($view, $params)->setFrom(\Yii::$app->params['adminEmail']);
    }

    /**
     * @return Email
     */
    public function send()
    {
        $this->mailer->send();
        return $this;
    }

    /**
     * @param $to
     * @return Email
     */
    public function setTo($to)
    {
        $this->mailer->setTo($to);
        return $this;
    }

    /**
     * @param $subject
     * @return Email
     */
    public function setSubject($subject)
    {
        $this->mailer->setSubject($subject);
        return $this;
    }
    
    protected static function sendCopyToAdmins($mail)
    {
        $admins = \Yii::$app->params['admins'];
        if (!is_array($admins)) {
            $admins = [$admins];
        }

        if (!is_array($mail)) {
            $mail = [$mail];
        }

        return array_merge($admins, $mail);
    }

    protected static function sendCopyToPartnerManagers($mail)
    {
        $managers = \Yii::$app->params['partner-managers'];
        if (!is_array($managers)) {
            $managers = [$managers];
        }

        if (!is_array($mail)) {
            $mail = [$mail];
        }

        return array_merge($managers, $mail);
    }

    public static function notify($set, $params)
    {
        $view = $set;
        switch ($set){
            case 'user/reset-password':
                $to = $params['model']->email;
                $subject = 'Восстановление пароля на Primekraft';
                break;
            case 'user/change-password':
                $to = $params['model']->email;
                $subject = 'Сменен пароль на Primekraft';
                break;
            case 'user/create':
                $to = $params['model']->email;
                $subject = 'Регистрация на Primekraft';
                break;
            case 'order/change':
                $to = $params['order']->email;
                $subject = 'Заказ №' . $params['order']->id;
                break;
            case 'order/customer':
                $to = $params['order']->email;
                $subject = 'Заказ №' . $params['order']->id;
                break;
            case 'order/customer_after_pay':
                $to = $params['order']->email;
                $subject = 'Заказ №' . $params['order']->id . ' успешно оплачен';
                break;
            case 'order/manager':
                $to = static::sendCopyToAdmins(\Yii::$app->params['saleEmail']);
                if (!empty($params['order']->discount_id)) {
                    $to = static::sendCopyToPartnerManagers($to);
                }
                $subject = 'Заказ №' . $params['order']->id;
                break;
            case 'partner/payout':
                $to = User::findOne($params['model']->user_id)->email;
                $subject = 'Заявка на вывод средств';
                break;
            case 'partner/payout-manager':
                $to = static::sendCopyToAdmins(\Yii::$app->params['saleEmail']);
                $subject = 'Новая заявка на вывод средств';
                break;
            case 'partner/transaction':
                $to = User::findOne($params['model']->user_id)->email;
                $subject = 'Денежная операция';
                break;
            case 'partner/register':
                $to = static::sendCopyToAdmins(\Yii::$app->params['saleEmail']);
                $to = static::sendCopyToPartnerManagers($to);
                $subject = 'Новая регистрация партнера';
                break;
            case 'feedback/common':
                $to = \Yii::$app->params['saleEmail'];
                $subject = 'Запрос с сайта';
                break;
            case 'feedback/distribution':
                $to = \Yii::$app->params['saleEmail'];
                $subject = 'Запрос с сайта';
                break;
            default:
                throw new \InvalidArgumentException;
        }

        (new Email($view, $params))
            ->setTo($to)
            ->setSubject($subject)
            ->send();
    }
}
