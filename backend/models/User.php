<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;
use yii\db\Exception;
use yii\web\IdentityInterface;
use Yii;

class User extends ActiveRecord implements IdentityInterface
{
    public string $confirmPassword = '';

    //TODO возможно сценарии
    public function rules(): array
    {
        return [
            [['login', 'password', 'role_id'], 'required'],
            [['login', 'password', 'confirmPassword', 'avatar', 'phone', 'email', 'access_token'], 'string'],
            [['confirmPassword'], 'validateConfirmPassword'],
            [['login'], 'unique'],
            [['role_id'], 'default'],
            [['confrimPassword'], 'safe']
        ];
    }

    public function validateConfirmPassword($attribute, $params)
    {
        if ($this->password !== $this->$attribute) {
            $this->addError($attribute, 'Пароли не совпадают');
        }
    }

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

    public function login($data)
    {
        if($data){
            $model = User::findOne(['login' => $data['login']]);
            $model->access_token = Yii::$app->security->generateRandomString();
            if(!Yii::$app->security->validatePassword($data['password'], $model->password)){
                throw new Exception('Пароль не подходит!');
            }
            return true;
        }
        return false;
    }

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

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getRole(): ActiveQuery
    {
        return $this->hasOne(Role::class, ['id' => 'role_id']);
    }

    public static function findIdentity($id)
    {
        if (!$model = User::findOne($id)) {
            throw new Exception('Модель пользователя с ID:' . $id . 'не надйена');
        }
        return $model;
    }

    public function getBanned(): ActiveQuery
    {
        return $this->hasOne(Banned::class, ['user_id' => 'id']);
    }


    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }

    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }
}
