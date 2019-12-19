<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "restore_token".
 *
 * @property integer $id
 * @property string $created
 * @property string $token
 * @property integer $user_id
 */
class RestoreToken extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'restore_token';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created', 'token', 'user_id'], 'required'],
            [['created'], 'safe'],
            [['user_id'], 'integer'],
            [['token'], 'string', 'max' => 32],
            [['token'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created' => 'Created',
            'token' => 'Token',
            'user_id' => 'User ID',
        ];
    }

    public static function generate($user)
    {
        $token = new self;
        $token->user_id = $user->id;
        $token->created = date('Y-m-d H:i:s');
        $token->token = md5(uniqid() . $token->created . $token->user_id);
        $token->save();

        return $token->token;
    }
}
