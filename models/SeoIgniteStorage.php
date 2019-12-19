<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%seo_ignite}}".
 *
 * @property string $url
 * @property string $title
 * @property string $description
 * @property string $keywords
 * @property string $h1
 * @property string $og_url
 * @property string $og_type
 * @property string $og_site_name
 * @property string $og_title
 * @property string $og_description
 * @property string $og_image
 *
 */
class SeoIgniteStorage extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%seo_ignite}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url'], 'required'],
            [['url'], 'unique'],
            [
                [
                    'title', 'description', 'keywords', 'h1',
                    'og_url', 'og_site_name', 'og_type',
                    'og_title', 'og_description', 'og_image'
                ], 'string'
            ],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'url' => 'URL',
            'title' => 'Title',
            'description' => 'Description',
            'keywords' => 'Keywords',
            'h1' => 'H1',
            'og_url' => 'og:url',
            'og_type' => 'og:type',
            'og_site_name' => 'og:site_name',
            'og_title' => 'og:title',
            'og_description' => 'og:description',
            'og_image' => 'og:image (url)'
        ];
    }
}
