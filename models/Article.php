<?php

namespace app\models;

use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property string $url
 * @property string $title
 * @property string $date
 * @property string $text
 * @property string $announce
 * @property UploadedFile $image
 * @property integer $public
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    public function behaviors()
    {
        return [
            [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'date',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'date'
                ],
                'value' => function ($event) {
                    return date('Y-m-d H:i:s', strtotime($this->date));
                },
            ],
        ];
    }

    private $oldImage;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'date', 'url'], 'required'],
            [['date'], 'date', 'format' => 'php:d.m.Y'],
            [['text', 'announce'], 'string'],
            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['public'], 'boolean'],
            [['title'], 'string', 'max' => 255],
            [['url'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'URL',
            'title' => 'Заголовок',
            'date' => 'Дата',
            'text' => 'Содержание',
            'announce' => 'Краткий анонс',
            'image' => 'Изображение',
            'public' => 'Опубликовано',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if(!$insert && $this->image){
                @unlink(\Yii::getAlias('@webroot').$this->oldAttributes['image']);
            }
            if ($this->image) {
                $this->image = \app\helpers\Image::upload($this->image, 'articles');
            } elseif (!$insert) {
                $this->image = $this->oldImage;
            }
            return true;
        } else {
            return false;
        }
    }

    public function afterFind()
    {
        parent::afterFind();
        $this->date = date('d.m.Y', strtotime($this->date));
        $this->oldImage = $this->image;
    }
}
