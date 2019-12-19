<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalogue_tags_2_category".
 *
 * @property integer $id
 * @property integer $category_id
 * @property integer $tag_id
 */
class CatalogueTags2Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'catalogue_tags_2_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'tag_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'tag_id' => 'Tag ID',
        ];
    }
}
