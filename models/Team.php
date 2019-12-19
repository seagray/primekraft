<?php

namespace app\models;

use yii;

/**
 * This is the model class for table "team".
 *
 * @property integer $id
 * @property string $name
 * @property string $photo
 * @property string $phones
 * @property string $email
 */
class Team extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'team';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'phones', 'email'], 'string', 'max' => 255],
            [['public'], 'inteder'],
            [['photo'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'ФИО',
            'photo' => 'Фотография',
            'phones' => 'Телефоны',
            'email' => 'E-mail',
            'public' => 'Опубликована',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if(!$insert && $this->photo != $this->oldAttributes['photo'] && $this->oldAttributes['photo']){
                @unlink(Yii::getAlias('@webroot').$this->oldAttributes['photo']);
            }
            return true;
        } else {
            return false;
        }
    }
}
