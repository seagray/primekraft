<?php

namespace app\components;

/**
 * Class SeoIgniteController
 * @package app\components
 *
 * @property string $h1
 */
class SeoIgniteController extends \yii\web\Controller
{
    public $h1;

    protected function generateSeoMeta()
    {
        $storage = \app\models\SeoIgniteStorage::findOne([
            'url' => '/' . \Yii::$app->request->pathInfo
        ]);
        if (empty($storage)) {
            return;
        }

        $view = \Yii::$app->view;

        if (!empty($storage->title)) {
            $view->title = $storage->title;
        }
        if (!empty($storage->h1)) {
            $this->h1 = $storage->h1;
        }

        foreach (['description', 'keywords'] as $attr) {
            if (!empty($storage->$attr)) {
                $view->registerMetaTag([
                    'name' => $attr,
                    'content' => $storage->$attr
                ]);
            }
        }

        foreach (['url', 'type', 'site_name', 'title', 'description', 'image'] as $og_attr) {
            if (!empty($storage->{'og_' . $og_attr})) {
                $view->registerMetaTag([
                    'property'=>'og:' . $og_attr,
                    'content' => $storage->{'og_' . $og_attr}
                ]);
            }
        }
    }

    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            $this->generateSeoMeta();
            return true;
        }
        return false;
    }

}