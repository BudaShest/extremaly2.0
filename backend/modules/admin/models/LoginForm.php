<?php

namespace app\modules\admin\models;

use yii\base\Model;
use app\modules\admin\models\User;

class LoginForm extends Model
{
    public string $login;
    public string $password;

    public function rules()
    {
        return [
            [['login', 'password'], 'required'],
            [['login'], 'string', 'minLength'=>4]

        ];
    }

    public function login($request)
    {

    }

}