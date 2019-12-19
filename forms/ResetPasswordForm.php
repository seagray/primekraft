<?php
namespace app\forms;

use app\models\User;
use yii\base\Model;

/**
 * Class FeedbackForm
 * @package app\forms
 * @property string phone
 */
class ResetPasswordForm extends Model
{
    public $username;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['username'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => "Логин"
        ];
    }
}
