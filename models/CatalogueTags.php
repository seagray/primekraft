<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalogue_tags".
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property integer $hidden
 * @property string $text
 */
class CatalogueTags extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'catalogue_tags';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hidden'], 'integer'],
            [['text'], 'string'],
            [['name', 'slug'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'slug' => 'Часть URL',
            'hidden' => 'Скрытая',
            'text' => 'Описание',
            'categoriesList' => 'Категории'
        ];
    }

    public static function getList()
    {
        $result = [];
        foreach (static::find()->all() as $tag) {
            $result[$tag->id] = $tag->name;
        }
        return $result;

    }

    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])
                    ->viaTable('catalogue_tags_2_category', ['tag_id' => 'id']);
    }

    public function getCategoriesList()
    {
        $htmlList = '';
        foreach ($this->categories as $category) {
            $htmlList .= $category->name . '<br/>';
        }
        return $htmlList;
    }
}
