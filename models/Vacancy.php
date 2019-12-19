<?php
namespace app\models;

use Yii;

/**
 * This is the model class for table "vacancy".
 *
 * @property integer $id
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $file
 * @property string $comment
 * @property string $dt
 * @property string $vk_profile
 * @property string $instagram_profile
 * @property string $youtube_profile
 * @property integer $referrer_id
 *
 */
class Vacancy extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vacancy';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'phone', 'email'], 'required'],
            [['comment', 'vk_profile', 'instagram_profile', 'youtube_profile'], 'string'],
            [['name'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 30],
            [['email'], 'string', 'max' => 255],
            [['email'], 'validateUniqueEmail']
//            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'doc, docx, pdf'],
        ];
    }

    public function validateUniqueEmail($attr, $params)
    {
        $count = User::find()->where(['email' => $this->email])->count();
        if ($count > 0) {
            $this->addError('email', 'Партнер с данным Email уже зарегистрирован');
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'phone' => 'Телефон',
            'email' => 'Email',
            'file' => 'Файл',
            'comment' => 'Комментарий',
            'dt' => 'Дата создания',
            'vk_profile' => 'Ссылка на профиль ВКонтакте',
            'instagram_profile' => 'Ссылка на профиль в Instagram',
            'youtube_profile' => 'Ссылка на профиль на youtube',
        ];
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return User::findOne(['email' => $this->email]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReferrer()
    {
        return $this->hasOne(User::className(), ['id' => 'referrer_id']);
    }
}