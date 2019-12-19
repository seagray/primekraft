<?php

namespace app\helpers;

use app\models\SeoIgniteImage;
use yii\helpers\Html;
use yii\helpers\Url;

class SeoOut
{
    /**
     * @param \app\components\SeoIgniteController | \yii\web\View $context
     * @param string | null $default
     * @param array $htmlOptions
     * @return string
     */
    public static function h1($context, $default = null, $htmlOptions = [])
    {
        if (($h1 = static::findValue($context, 'h1', $default)) !== null) {
            return Html::tag('h1', $h1, $htmlOptions);
        }
        return '';
    }

    /**
     * @param \yii\web\View $context
     * @param string | null $default
     * @param array $htmlOptions
     * @return string
     */
    public static function title($context, $default = null, $htmlOptions = [])
    {
        if (($title = static::findValue($context, 'title', $default)) !== null) {
            return Html::tag('title', $title, $htmlOptions);
        }
        return '';
    }

    /**
     * Создание изображения с атрибутами ALT и TITLE.
     * Атрибуты по-умолчанию передаются через $htmlOptions
     * @param $src
     * @param array $htmlOptions
     * @param int|null $width
     * @param int|null $height
     * @return string
     */
    public static function img($src, $htmlOptions = [], $width = null, $height = null)
    {
        if (empty($src)) {
            return '';
        }

        $image = SeoIgniteImage::findOne(['src' => $src]);
        if (empty($image)) {
            $image = new SeoIgniteImage();
            $image->src = $src;
            if (isset($htmlOptions['alt'])) {
                $image->alt = $htmlOptions['alt'];
            }
            if (isset($htmlOptions['title'])) {
                $image->title = $htmlOptions['title'];
            }
            $image->save();
        } else {
            $htmlOptions['alt'] = $image->alt;
            $htmlOptions['title'] = $image->title;
        }

        if ($width || $height) {
            $htmlOptions['data-src'] = $src;
            $src = Image::thumbnail($src, $width, $height);
        }

        $img = Html::img($src, $htmlOptions);

        if (Admin::isLiveEdit()) {
            $img .= Html::a(
                '<b>SEO</b>',
                Url::to(['/admin/seo-ignite/image-update', 'id' => $image->id]),
                [
                    'target' => '_blank',
                    'style' => 'display: block; z-index: 9999; position: relative; top: -20px; left: -35px; width: 35px; heigth: 20px; 
                    background-color: #80FF00; border: solid 1px red; text-align: center;'
                ]
            );
        }

        return $img;
    }

    /**
     * @param $context
     * @param $attribute
     * @return null
     */
    private static function findValue($context, $attribute, $default = null) {
        if ($context && isset($context->$attribute) && !empty($context->$attribute)) {
            return $context->$attribute;
        } else if($context && isset($context->context)
            && isset($context->context->$attribute) && !empty($context->context->$attribute))  {
            return $context->context->$attribute;
        }
        return $default;
    }
}