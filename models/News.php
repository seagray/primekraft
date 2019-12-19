<?php

namespace app\models;

use yii;

/**
 * This is the model class for table "news".
 *
 * @property integer $id
 * @property string $title
 * @property string $date
 * @property string $text
 * @property string $announce
 * @property string $image
 * @property integer $public
 */
class News extends \yii\db\ActiveRecord
{
    public function init()
    {
        $this->public = 0;
        parent::init(); // TODO: Change the autogenerated stub
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'text', 'date'], 'required'],
            [['text', 'announce'], 'string'],
            [['public'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if(!$insert && $this->image != $this->oldAttributes['image'] && $this->oldAttributes['image']){
                @unlink(Yii::getAlias('@webroot').$this->oldAttributes['image']);
            }
            return true;
        } else {
            return false;
        }
    }

    public function date($format = 'd.m.Y')
    {
        return date($format, strtotime($this->date));
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'date' => 'Дата',
            'text' => 'Текст',
            'image' => 'Изображение',
            'public' => 'Опубликована',
            'announce' => 'Краткий анонс'
        ];
    }
}