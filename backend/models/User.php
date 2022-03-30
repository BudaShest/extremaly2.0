<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;
use yii\web\IdentityInterface;
use Yii;

class User extends ActiveRecord implements IdentityInterface
{
    public string $confirmPassword;

    //TODO возможно сценарии
    public function rules(): array
    {
        return [
            [['login', 'password', 'confirmPassword', 'role_id'], 'required'],
            [['login', 'password', 'confirmPassword', 'avatar'], 'string'],
            [['confirmPassword'], 'validateConfirmPassword'],
            [['login'], 'unique'],
            [['role_id'], 'default'],
            ['confrimPassword', 'safe']
        ];
    }

    public function validateConfirmPassword($attribute, $params){
        if($this->password !== $this->$attribute){
            $this->addError($attribute, 'Пароли не совпадают');
        }
    }

    public function register($data): bool
    {
        if($data){
            $this->attributes = $data;
            $this->role_id = Role::DEFAULT_ROLE_ID;
            if(!$this->validate()){
                return false;
            }
            $this->password = Yii::$app->security->generatePasswordHash($this->password);
            return $this->save(false);
        }
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
        // TODO: Implement findIdentity() method.
    }

    public function getId()
    {
        // TODO: Implement getId() method.
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