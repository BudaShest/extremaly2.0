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
                throw new NotFoundHttpException('Пользователь с логином ' . $request['login'] . ' не найднен');
            }
            if(!Yii::$app->user->login($model)){
                Yii::$app->session->setFlash('error', 'Не удалось авторизоваться');
                return false;
            }
            return true;
        }
    }

}