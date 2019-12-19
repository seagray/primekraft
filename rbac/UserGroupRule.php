<?php
namespace app\rbac;

use Yii;
use yii\rbac\Rule;

class UserGroupRule extends Rule
{
    public $name = 'userGroup';

    public function execute($user, $item, $params)
    {
        if (!\Yii::$app->user->isGuest) {
            $role = \Yii::$app->user->identity->role;
            if ($item->name === 'admin') {
                return $role == 'admin';
            } elseif ($item->name === 'partner_manager') {
                return $role == 'partner_manager';
            } elseif ($item->name === 'agent') {
                return $role == 'agent';
            }
        }
        return false;
    }
}