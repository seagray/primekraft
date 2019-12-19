<?php

namespace app\models;

use yii;
use yii\helpers\Url;
use app\helpers\Admin;

/**
 * This is the model class for table "content_block".
 *
 * @property integer $id
 * @property string $title
 * @property string $name
 * @property string $text
 */
class Content extends yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'content_block';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'name'], 'required'],
            [['text'], 'string'],
            [['title', 'name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Комментарий',
            'name' => 'Название блока',
            'text' => 'Содержимое',
        ];
    }

    public static function text($name, $default = null)
    {
        $block = self::findOne(['name' => $name]);

        if (!$block) {
            $block = new static();
            $block->name = $name;
            $block->title = 'Автосоздан из: ' . $name;
            $block->text = $default;
            $block->save();
        }

        return (Admin::isLiveEdit() ? '<div class="changeContent material-icons" data-edit-url="'.Url::toRoute(['admin/content/liveedit', 'name' => urlencode($name)]) . '">border_color</div>':'') . $block->text;
    }

    /**
     * @deprecated
     * @param $name
     * @return string
     */
    public static function getByName($name)
    {
        if ($r = self::findOne(['name' => $name])){
            return $r->text;
        }
        return "";
    }
}
