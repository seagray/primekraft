<?php

namespace app\models;

use yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $name
 * @property string $ord
 * @property integer $public
 * @property integer $type
 * @property integer $image
 * @property string $slug
 *
 * @property integer $lineNumberOnMainPage
 *
 * @property string $url
 * @property Product[] $products
 */
class Category extends yii\db\ActiveRecord
{
    private $_cache = [];

    const TYPE_COMBO = 1;
    const TYPE_SINGLE = 2;

    /**
     * @var UploadedFile
     */

    public function init()
    {
        //default
        $this->ord = 0;
        $this->public = 0;

        parent::init(); // TODO: Change the autogenerated stub
    }

    public static function findListByLines()
    {
        $list = [];

        foreach (static::find()->where(['public' => 1])->orderBy('lineNumberOnMainPage ASC, ord ASC')->all() as $cat) {
            if (!isset($list[$cat->lineNumberOnMainPage])) {
                $list[$cat->lineNumberOnMainPage] = [];
            }
            $list[$cat->lineNumberOnMainPage][] = $cat;
        }

        return $list;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'slug'], 'required'],
            [['slug'], 'unique'],
            [['ord', 'public', 'type', 'lineNumberOnMainPage'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
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
            'lineNumberOnMainPage' => 'Номер в строке на главной странице',
            'image' => 'Изображение',
            'ord' => 'Порядок следования',
            'public' => 'Опубликована',
            'groupsList' => 'Группы'
        ];
    }

    /**
     * @return Product[]
     */
    public function getProducts()
    {
        if (!isset($this->_cache['products'])){
            $this->_cache['products'] = Product::find()->where(['category_id' => $this->id, 'public' => 1])->orderBy('ord ASC')->all();
            foreach ($this->_cache['products'] as &$product) {
                $product->cat = $this;
            }
        }
        return $this->_cache['products'];
    }

    /**
     * @return static[]
     */
    public static function getAllPublic()
    {
        return Category::findAll(['public' => 1]);
    }

    public static function getAllPublicList()
    {
        $result = [];
        foreach (static::getAllPublic() as $cat) {
            $result[$cat->id] = $cat->name;
        }
        return $result;
    }

    public static function getTypeList()
    {
        return [
            self::TYPE_COMBO => 'Комбовкус',
            self::TYPE_SINGLE => 'Один вкус'
        ];
    }

    public function isCombobox()
    {
        return $this->type == self::TYPE_COMBO;
    }


    public function isSingletaste()
    {
        return $this->type == self::TYPE_SINGLE;
    }

    public function getUrl()
    {
        if ($this->slug) {
            return yii\helpers\Url::to(['catalogue/category', 'category' => $this->slug]);
        } else {
            return yii\helpers\Url::to(['catalogue/category', 'id' => $this->id]);
        }
    }

    public function getGroups()
    {
        return $this->hasMany(CatalogueTags::className(), ['id' => 'tag_id'])
                    ->viaTable('catalogue_tags_2_category', ['category_id' => 'id']);
    }

    public function getGroupsList()
    {
        $htmlList = '';
        foreach ($this->groups as $group) {
            $htmlList .= $group->name . '<br/>';
        }
        return $htmlList;
    }
}
