<?php
namespace app\commands;

use app\models\User;
use Yii;
use yii\console\Controller;
use \app\rbac\UserGroupRule;

class RbacController extends Controller
{
    public $username;
    public $password;
    public $role;

    public function actionInit()
    {
        $authManager = \Yii::$app->authManager;

        $authManager->removeAll();

        // Создание ролей
        $guest  = $authManager->createRole('guest');
        $agent = $authManager->createRole('agent');
        $admin  = $authManager->createRole('admin');
        $partner_manager  = $authManager->createRole('partner_manager');

        // Создание правил
        $view_admin   = $authManager->createPermission('view_admin');
        $view_agent   = $authManager->createPermission('view_agent');
        $view_partner_manager   = $authManager->createPermission('view_partner_manager');
        $authManager->add($view_admin);
        $authManager->add($view_agent);
        $authManager->add($view_partner_manager);


        // Add rule, based on UserExt->group === $user->group
        $userGroupRule = new UserGroupRule();
        $authManager->add($userGroupRule);

        // Add rule "UserGroupRule" in roles
        $guest->ruleName  = $userGroupRule->name;
        $admin->ruleName  = $userGroupRule->name;
        $agent->ruleName  = $userGroupRule->name;
        $partner_manager->ruleName =   $userGroupRule->name;

        // Add roles in Yii::$app->authManager
        $authManager->add($guest);
        $authManager->add($admin);
        $authManager->add($agent);
        $authManager->add($partner_manager);

        // Add permission-per-role in Yii::$app->authManager
        // agent
        $authManager->addChild($agent, $view_agent);
        $authManager->addChild($partner_manager, $view_partner_manager);

        // Admin
        $authManager->addChild($admin, $view_admin);
    }

    public function options($actionID)
    {
        return [
            'username',
            'password',
            'role'
        ];
    }

    public function optionAliases()
    {
        return [
            'u' => 'username',
            'p' => 'password',
            'r' => 'role'
        ];
    }

    /**
     * Создает пользователя с указанной ролью
     * @param $username
     * @param $password
     * @param $role
     * @return integer
     */
    public function actionCreate($username, $password, $role)
    {
        $user = new User();
        $user->role = $role;
        $user->username = $username;
        $user->email = $username . '@example.com';
        $user->password_hash = md5($password);
        try {
            $user->save();
        } catch (\Exception $e) {
            echo $e->getMessage();
            return 1;
        }

        echo "User {$user->username} was created with role {$user->role}\n";
        return 0;
    }

    /**
     * Изменение пользователя username
     * @param $username
     * @param $password
     * @param $role
     * @throws \yii\base\Exception
     * @return integer
     */
    public function actionChange($username, $password=null, $role=null)
    {
        $user = User::findByUsername($username);
        if (!$user) {
            echo "User {$username} doesn't exist\n";
            return 1;
        }
        if (!is_null($password)) {
            $user->password_hash = md5($password);
        }
        if (!is_null($role)) {
            $user->role = $role;
        }
        $user->save();
        echo "User successful changed\n";
        return 0;
    }
}
