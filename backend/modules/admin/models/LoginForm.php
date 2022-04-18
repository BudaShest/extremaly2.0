<?php

namespace app\modules\admin\models;

use yii\base\Model;
use app\models\User;
use Yii;
use yii\web\NotFoundHttpException;

class LoginForm extends Model
{
    public string $login = '';
    public string $password = '';

    public function rules()
    {
        return [
            [['login', 'password'], 'required'],
        ];
    }

    public function login($request): bool
    {
        if($request = $request['LoginForm']){
            if(!$model = User::findOne(['login' => $request['login']])){
                $this->addError('login','Пользователь с таким логином отсутствует!');
                return false;
            }
            if(!Yii::$app->security->validatePassword($request['password'], $model->password)){
                $this->addError('password','Неправильный пароль');
                return false;
            }
            if($model->role_id != 1){
                $this->addError('role_id','Недостаточно прав!');
                return false;
            }
            if(!Yii::$app->user->login($model)){
                Yii::$app->session->setFlash('error', 'Не удалось авторизоваться');
                return false;
            }
            return true;
        }
    }
}
