<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%seo_ignite_img}}".
 *
 * @property string $url
 * @property string $src
 * @property string $alt
 * @property string $title
 *
 */
class SeoIgniteImage extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%seo_ignite_img}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['src'], 'required'],
            [['src'], 'unique'],
            [['title', 'alt'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'src' => 'URL изображения',
            'title' => 'Title',
            'alt' => 'Alt'
        ];
    }
}
