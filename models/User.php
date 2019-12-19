<?php

namespace app\models;

use app\components\Email;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "user".
 *
 * @property string $nickname
 * @property string $role
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $password_hash
 * @property boolean $is_code
 * @property integer referrer_id
 *
 * @property Discount $discount
 */
class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    protected $_cache = [];

    public $newPassword = '';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role', 'username', 'email', 'nickname'], 'safe'],
            [['role', 'password_hash', 'email', 'username', 'nickname'], 'required'],
            [['email'], 'unique'],
            [['email'], 'email']
        ];
    }

    public function __toString()
    {
        $str = sprintf("%s <%s>", $this->nickname, $this->email);
        return $str;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'email' => 'Email',
            'role' => 'Роль',
            'password_hash' => 'Пароль',
            'nickname' => 'Имя',
            'hold' => 'Баланс, руб.',
            'pay' => 'Начислено, руб.',
            'payout' => 'Выведено, руб.',
            'is_code' => 'Есть код',
            'referrer_id' => 'Реферрер'
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {

        return static::findOne(['id' => 1]);
        //return $obUser;
    }

    /**
     * Finds user by username
     *
     * @param  string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return false;
    }

    public function getRole()
    {
        return $this->role;
    }

    /**
     * Validates password
     *
     * @param  string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password_hash === md5($password);
    }

    public function getDiscount()
    {
        if (!isset($this->_cache['discount'])) {
            $this->_cache['discount'] = Discount::find()->where(['user_id' => $this->id])->one();;
        }
        return $this->_cache['discount'];
    }

    public function createDiscount($template)
    {
        $discount = new Discount();
        $discount->code = '';
        $discount->lifetime = null;
        $discount->user_id = $this->id;
        $discount->date = date('Y-m-d H:i:s');
        $discount->save();

        foreach ($template as $productId => $percent) {
            $value = new DiscountValue();
            $value->discount_id = $discount->id;
            $value->product_id = $productId;
            $value->percent = $percent;
            $value->save();
        }
        $this->is_code = true;
        $this->save();
        return $discount;
    }

    public function beforeValidate()
    {
        if (!empty($this->newPassword)) {
            $this->password_hash = md5($this->newPassword);
        }
        return parent::beforeValidate();
    }

    public function beforeSave($insert)
    {
        if ($insert) {
            Email::notify('user/create', [
                'model' => $this,
                'password' => $this->newPassword
            ]);
        }
        return parent::beforeSave($insert);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReferrer()
    {
        return $this->hasOne(User::className(), ['id' => 'referrer_id']);
    }

    public static function roleList()
    {
        return ['admin' => 'Админ', 'partner_manager' => 'Менеджер партнеров', 'agent' => 'Партнер'];
    }

    public function getRoleTitle()
    {
        return static::roleList()[$this->role];
    }
}
