<?php

namespace app\models;

use yii;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property string $name
 * @property double $price
 * @property integer $category_id
 * @property integer $portions_count
 * @property integer $weight
 * @property string $description
 * @property string $images
 * @property integer $public
 * @property boolean $available
 * @property string $slug
 *
 * @property string $ozon_url
 * @property boolean $ozon_url_http_ok
 *
 * @property string $ulmart_url
 * @property boolean $ulmart_url_http_ok
 *
 * @property string $wildberries_url
 * @property boolean $wildberries_url_http_ok
 *
 * @property string $url
 * @property Portion[] $portions
 * @property Flavor[] $flavors
 * @property Category $category
 * @property Portion $portion
 * @property string $displayName
 */
class Product extends \yii\db\ActiveRecord
{
    private $_cache;

    /**
     * @var Category
     */
    public $cat;

    public function init()
    {
        $this->ord = 0;
        parent::init(); // TODO: Change the autogenerated stub
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    private static $externalUrls = ['ozon_url', 'ulmart_url', 'wildberries_url'];

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['price', 'portions_count', 'weight'], 'required'],
            [['price'], 'number'],
            [['price', 'weight'], 'compare', 'compareValue' => 0, 'operator' => '>='],
            [['portions_count'], 'compare', 'compareValue' => 0, 'operator' => '>'],
            [['category_id', 'portions_count', 'weight', 'public', 'ord'], 'integer'],
            [['available'], 'boolean'],
            [['description', 'slug'], 'string'],
            [['name'], 'string', 'max' => 255],
            [self::$externalUrls, 'string', 'max' => 512],
            [['images'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 10],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
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
            'price' => 'Цена',
            'category_id' => 'Категория',
            'portions_count' => 'Количество порций',
            'weight' => 'Вес',
            'description' => 'Описание',
            'images' => 'Изображения',
            'public' => 'Опубликован',
            'ord' => 'Порядок следования',
            'available' => 'Есть в наличии',
            'ozon_url' => 'Ссылка на OZON'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPortions()
    {
        return $this->hasMany(Portion::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFlavors()
    {
        if (!isset($this->_cache['flavors'])) {
            $this->_cache['flavors'] = $this->hasMany(Flavor::className(), ['id' => 'flavor_id'])->viaTable(
                'portion',
                ['product_id' => 'id']
            );
        }
        return $this->_cache['flavors'];
    }

    public function isCombobox()
    {
        return count($this->flavors) > 1;
    }


    public function isSingletaste()
    {
        return count($this->flavors) == 1;
    }

    /**
     * @return Portion
     */
    public function getPortion()
    {
        if (!isset($this->_cache['portion'])){
            $this->_cache['portion'] = $this->portions[0];
        }
        return $this->_cache['portion'];
    }

    public function getDisplayName()
    {
        if (count($this->flavors) > 1){
            return $this->name;
        } else {
            return $this->category->name . " " . $this->portion->flavor->name;
        }
    }

    public function getUrl()
    {
        if ($this->cat && $this->cat->slug && $this->slug){
            return yii\helpers\Url::to(['/catalogue/item', 'category' => $this->cat->slug, 'item' => $this->slug]);
        } else {
            return yii\helpers\Url::to(['/catalogue/item', 'id' => $this->id]);
        }
    }

    /**
     * @return $this
     */
    public function checkUrls()
    {
        foreach (self::$externalUrls as $prop) {
            if ($this->$prop) {
                $headers = get_headers($this->$prop);
                $this->{$prop . '_http_ok'} = substr($headers[0], 9, 3) !== '404';
            } else {
                $this->{$prop . '_http_ok'} = false;
            }
        }
        return $this;
    }

    public function beforeSave($insert)
    {
        $this->checkUrls();

        return parent::beforeSave($insert);
    }

    public function __toString()
    {
        return $this->getDisplayName();
    }

    public function hasMarketUrl()
    {
        return $this->ozon_url && $this->ozon_url_http_ok
            || $this->ulmart_url && $this->ulmart_url_http_ok
            || $this->wildberries_url &``& $this->wildberries_url_http_ok;

    }
}
