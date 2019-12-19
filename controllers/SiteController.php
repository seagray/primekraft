<?php

namespace app\controllers;

use app\components\BaseController;
use app\components\Email;
use app\forms\ResetPasswordForm;
use app\models\CatalogueTags;
use app\models\Discount;
use app\models\LoginForm;
use app\models\RestoreToken;
use app\models\User;
use app\rbac\UserGroupRule;
use yii;
use app\models\Category;
use yii\helpers\Url;

/**
 * Class SiteController
 * @package app\controllers
 */
class SiteController extends BaseController
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionSitemap()
    {
        $this->layout = false;
        return $this->renderPartial('sitemap');
    }

    /* Отключено, потому что сервер заменяет заголовок Content-Type
     *
    public function actionRobots()
    {
        header("Cache-Control: max-age=0", false);
        header("Pragma: no-cache");
        header('Content-Type: text/plain');
        if (YII_ENV_DEV) {
            echo $this->renderPartial('robots-dev');
        } else {
            echo $this->renderPartial('robots');
        }
        \Yii::$app->end();
    }
    */

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            Yii::$app->user->logout();
        }

        Yii::$app->params['current_page'] = "login";

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if ($model->getRole() == 'admin' || $model->getRole() == 'partner_manager' ) {
                $this->redirect('/admin');
                return true;
            }

            if ($model->getRole() == 'agent') {
                $this->redirect('/personal');
                return true;
            }

            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect(['index']);
    }

    private function actionRbac()
    {

        $authManager = \Yii::$app->authManager;

        // Создание ролей
        $guest = $authManager->createRole('guest');
        $agent = $authManager->createRole('agent');
        $admin = $authManager->createRole('admin');

        // Создание правил
        $view_admin = $authManager->createPermission('view_admin');
        $view_agent = $authManager->createPermission('view_agent');


        $authManager->add($view_admin);
        $authManager->add($view_agent);

        // Add rule, based on UserExt->group === $user->group
        $userGroupRule = new UserGroupRule();
        $authManager->add($userGroupRule);

        // Add rule "UserGroupRule" in roles
        $guest->ruleName = $userGroupRule->name;
        $admin->ruleName = $userGroupRule->name;
        $agent->ruleName = $userGroupRule->name;

        // Add roles in Yii::$app->authManager
        $authManager->add($guest);
        $authManager->add($admin);
        $authManager->add($agent);

        // agent
        $authManager->addChild($agent, $view_agent);

        // Admin
        $authManager->addChild($admin, $view_admin);
    }

    public function actions()
    {
        return [
            'error' => ['class' => 'yii\web\ErrorAction'],
        ];
    }

    /**
     * Default SiteAction. If view exists - render it, throws 404 otherwise
     * @return string
     * @throws yii\web\NotFoundHttpException
     */
    public function actionPage()
    {
        $view = Yii::$app->request->get('view');

        if ($view == 'index') {
            return $this->actionIndex();
        }

        try {
            $view = str_replace('..', '', ltrim($view, '/'));
            Yii::$app->params['current_page'] = $view;
            return $this->render($view);
        } catch (yii\base\InvalidParamException $e) {
            if ($group = CatalogueTags::findOne(['slug' => $view]))
            {
                /*
                $combobox = Category::find()->where(['public' => 1, 'type' => Category::TYPE_COMBO])->orderBy('ord ASC')->all();
                $single = Category::find()->where(['public' => 1, 'type' => Category::TYPE_SINGLE])->orderBy('ord ASC')->all();
                */




                Yii::$app->params['current_page'] = "catalogue";
                return $this->render("@app/views/catalogue/group.php", [
                    'group' => $group,
                //    'combobox' => $combobox,
                //    'singletaste' => $single
                ]);
            }
            throw new yii\web\NotFoundHttpException;
        }
    }

    public function actionResetPassword()
    {
        if (!\Yii::$app->user->isGuest) {
            Yii::$app->user->logout();
        }

        Yii::$app->params['current_page'] = "reset-password";

        $model = new ResetPasswordForm();
        $sent = false;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $user = User::findOne(['username' => $model->username]);
            if (!empty($user)) {
                Email::notify('user/reset-password', [
                    'model' => $user,
                    'restoreUrl' => Url::to(['/site/set-password', 'token' => RestoreToken::generate($user)], true),
                    'expire' => \Yii::$app->params['user']['restore_token_expire']
                ]);
            }
            $sent = true;
        }

        return $this->render('reset-password', [
            'model' => $model,
            'sent' => $sent
        ]);
    }
    
    public function actionSetPassword($token = null)
    {
        $failToken = false;

        $restoreToken = RestoreToken::findOne(['token' => $token]);
        if (empty($restoreToken)) {
            if (\Yii::$app->request->isPost) {
                return json_encode(['success' => false, 'errors' => [['Ссылка на смену пароля не действительна']]]);
            }
            $failToken = true;
        } else {
            $expire = \Yii::$app->params['user']['restore_token_expire'];
            if (($expire != 0) && ((strtotime($restoreToken->created) + $expire * 24 * 60 * 60) < time())) {
                $restoreToken->delete();
                $failToken = true;
            } else {
                if (\Yii::$app->request->isPost) {
                    $errors = [];

                    $password = \Yii::$app->request->post('password');
                    $password_repeat = \Yii::$app->request->post('password_repeat');
                    if ($password != $password_repeat) {
                        $errors['password_repeat'] = ['Вы ввели различные пароли'];
                    } else if (empty($password)) {
                        $errors['password'] = ['Пароль не должен быть пустым'];
                    } else {
                        $user = User::findOne(['id' => $restoreToken->user_id]);
                        if (!empty($user)) {
                            $user->newPassword = $password;
                            if ($user->save()) {
                                $restoreToken->delete();
                                Email::notify('user/change-password', [
                                    'model' => $user,
                                    'password' => $password,
                                    'resetUrl' => Url::to('/site/reset-password', true)
                                ]);
                                return json_encode(['success' => true, 'redirect' => Url::to('/site/login') ]);
                            }
                            return json_encode(['success' => false, 'errors' => yii\helpers\Html::errorSummary($user)]);
                        }
                    }
                    return json_encode(['success' => false, 'errors' => $errors]);
                }
            }
        }

        return $this->render('set-password', [
            'failToken' => $failToken
        ]);
    }
}
