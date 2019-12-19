<?php

namespace app\modules\admin\controllers;

use app\models\Vacancy;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use app\modules\admin\components\BaseController;

class VacancyController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        \Yii::$app->params['activePage'] = 'partner';
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin', 'partner_manager']
                    ]
                ],
            ]

        ];
    }

    /**
     * Список
     * @return string
     */
    public function actionIndex()
    {
        $obQuery =  Vacancy::find()->orderBy(['dt'=>SORT_DESC]);

        $dataProvider = new ActiveDataProvider([
            'query' =>$obQuery,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Просмотр
     * @param $id
     * @return string
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Удаление
     * @param $id
     * @return \yii\web\Response
     */
    public function actionDelete($id)
    {
        $obModel = $this->findModel($id);
        $obModel->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Vacancy the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Vacancy::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
