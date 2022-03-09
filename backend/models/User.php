<?php

use yii\db\ActiveRecord;

class User extends ActiveRecord
{
    public $uploads;

    public $confirmPassword;

    //TODO возможно сценарии
    public function rules()
    {
        return [
          [['login', 'password','confirmPassword','role_id'],'required'],
          [['login', 'password','confirmPassword', 'avatar'], 'string'],
          [['login'], 'unique'],
        ];
    }

    public function getRole()
    {
        return $this->hasOne(Role::class, ['id' => 'role_id']);
    }
}