<?php

namespace app\controllers;

use yii\filters\Cors;
use yii\rest\ActiveController;
use app\models\User;
use yii\filters\auth\HttpBasicAuth;
use Yii;

class UserController extends ActiveController
{
    public $modelClass = 'app\models\User';

    public function behaviors(): array
    {
        $behaviors = parent::behaviors();

        $behaviors['corsFilter'] = [ //TODO создать общий класс для контроллеров и вынести его туда
            'class' => Cors::class
        ];
//        $behaviors['authenticator'] = [
//            'class' => HttpBasicAuth::class,
//        ];

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
    }
}