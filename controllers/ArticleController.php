<?php

namespace app\controllers;

use app\components\BaseController;
use app\models\Article;
use yii\web\NotFoundHttpException;

/**
 * Class ArticleController
 * @package app\controllers
 */
class ArticleController extends BaseController
{
    public function init()
    {
        \Yii::$app->params['current_page'] = 'articles';
        parent::init();
    }

    public function actionIndex()
    {
        $list = Article::find()->where(['public' => true])->orderBy('date DESC')->all();
        return $this->render('index', ['list' => $list]);
    }

    public function actionItem($url)
    {
        $article = Article::findOne(['url' => $url, 'public' => true]);
        if (!$article) {
            throw new NotFoundHttpException();
        }

        $recommends = Article::find()->andWhere(['AND', ['!=', 'id', $article->id], ['public' => true]])->orderBy('RAND()')->all();

        while (count($recommends) > 3) {
            unset($recommends[rand(0, count($recommends))]);
            $recommends = array_values($recommends);
        }

        return $this->render('item', [
            'article' => $article,
            'recommends' => $recommends
        ]);
    }
}