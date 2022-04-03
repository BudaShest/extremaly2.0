<?php

namespace app\controllers;

use yii\filters\Cors;
use yii\rest\ActiveController;
use app\models\User;
use app\models\Banned;
use Yii;
use yii\filters\auth\HttpBearerAuth;

class UserController extends ActiveController
{
    public $modelClass = 'app\models\User';

    public function behaviors(): array
    {
        $behaviors = parent::behaviors();

        $behaviors['corsFilter'] = [ //TODO создать общий класс для контроллеров и вынести его туда
            'class' => Cors::class
        ];
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
        ];

        $behaviors['authenticator']['except'] = ['register', 'login'];

        return $behaviors;
    }


    public function actionRegister(){
        $model = new User();
        if($request = Yii::$app->request->post()){
            if(!$model->register($request)){
                return $model->errors;
            }
            return ["message" =>  $model->login . ' был успешно зарегистрирован'];
        }
        return ["message" => 'Пусой запрос!'];
    }

    public function actionLogin()
    {
        $model = new User();
        if($request = Yii::$app->request->post()){
            try{
                if(!$model->login($request)){
                    return $model->errors;
                }
                return ["message" =>  'Пользователь был успешно авторизован'];
            }catch (\Exception $e){
                return $e->getMessage();
            }
        }
        return ["message" =>  $model->login . ' был успешно авторизован'];
    }

}