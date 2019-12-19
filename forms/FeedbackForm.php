<?php
namespace app\forms;

use yii\base\Model;

/**
 * Class FeedbackForm
 * @package app\forms
 * @property string phone
 */
class FeedbackForm extends Model
{
    public $phone;
    public $email;
    public $message;

    public function rules()
    {
        return [
            [['phone', 'message'], 'required'],
            ['email', 'email'],
        ];
    }
}
