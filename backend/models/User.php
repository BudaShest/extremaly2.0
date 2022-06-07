<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;
use yii\db\Exception;
use yii\web\IdentityInterface;
use Yii;

/**
 * Класс пользователь
 * @property int $id - ID
 * @property string $login - Логин
 * @property string $password - Пароль
 * @property string $confirmPassword - Повторение пароля
 * @property string $email - Email
 * @property string $phone - Номер телефона
 * @property string $avatar - Аватар
 * @property int $role_id - Роль (id)
 */
class User extends ActiveRecord implements IdentityInterface
{
    /** @var string Повторение пароля */
    public string $confirmPassword = '';

    public function rules(): array
    {
        return [
            [['login', 'password', 'role_id'], 'required'],
            [['login', 'password', 'confirmPassword', 'avatar', 'phone', 'email', 'access_token'], 'string'],
            [['confirmPassword'], 'compare', 'compareAttribute' => 'password', 'message' => 'Пароли должны быть идентичны!'],
            [['phone'], 'unique'],
            [['email'], 'email'],
            [['email'], 'unique'],
            [['login'], 'unique'],
            [['confrimPassword'], 'safe']
        ];
    }

    /**
     * Валидация пароля на проверку
     * @param $attribute
     * @param $params
     * @return void
     * @deprecated
     */
    public function validateConfirmPassword($attribute, $params): void
    {
        if ($this->password !== $this->$attribute) {
            $this->addError($attribute, 'Пароли не совпадают');
        }
    }

    /**
     * Регистрация
     * @param $data
     * @return bool
     * @throws \yii\base\Exception
     */
    public function register($data): bool
    {
        if ($data) {
            $this->attributes = $data;
            $this->role_id = Role::DEFAULT_ROLE_ID;
            $this->ip = Yii::$app->request->userIP;
            if (!$this->validate()) {
                return false;
            }
            $this->password = Yii::$app->security->generatePasswordHash($this->password);
            return $this->save(false);
        }
        return false;
    }

    /**
     * Авторизация
     * @param $data
     * @return bool - результат авторизации
     * @throws Exception
     * @throws \yii\base\Exception
     */
    public function login($data): bool
    {
        if ($data) {
            $model = User::findOne(['login' => $data['login']]);
            $model->access_token = Yii::$app->security->generateRandomString();
            if (!Yii::$app->security->validatePassword($data['password'], $model->password)) {
                throw new Exception('Пароль не подходит!');
            }
            return true;
        }
        return false;
    }

    /** @inheritdoc */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->access_token = Yii::$app->security->generateRandomString();
            }
            return true;
        }
        return false;
    }

    /** @inheritdoc */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /** @inheritdoc */
    public static function findIdentity($id)
    {
        if (!$model = User::findOne($id)) {
            throw new Exception('Модель пользователя с ID:' . $id . 'не надйена');
        }
        return $model;
    }

    /**
     * Роль (relation)
     * @return ActiveQuery
     */
    public function getRole(): ActiveQuery
    {
        return $this->hasOne(Role::class, ['id' => 'role_id']);
    }

    /**
     * Бан (relation)
     * @return ActiveQuery
     */
    public function getBanned(): ActiveQuery
    {
        return $this->hasOne(Banned::class, ['user_id' => 'id']);
    }

    /** @inheritdoc */
    public function getId()
    {
        return $this->id;
    }

    /** @inheritdoc */
    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }

    /** @inheritdoc */
    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }
}
