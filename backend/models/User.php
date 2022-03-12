<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;

class User extends ActiveRecord
{
    public $uploads;

    public $confirmPassword;

    //TODO возможно сценарии
    public function rules(): array
    {
        return [
            [['login', 'password', 'confirmPassword', 'role_id'], 'required'],
            [['login', 'password', 'confirmPassword', 'avatar'], 'string'],
            [['login'], 'unique'],
        ];
    }

    public function getRole(): ActiveQuery
    {
        return $this->hasOne(Role::class, ['id' => 'role_id']);
    }
}