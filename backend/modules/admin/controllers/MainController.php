<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\LoginForm;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\User;
use Yii;

class MainController extends Controller
{
//    public function behaviors()
//    {
//        return [
//            'access' => [
//                'class' => AccessControl::class,
//                'only' => ['login', 'main'],
//                'rules' => [
//                    [
//                        'allow' => true,
//                        'actions' => ['login', 'main'],
//                        'roles' => ['*'],
//                    ]
//                ]
//            ]
//        ];
//    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        $model = new LoginForm();
        if($request = Yii::$app->request->post()){
            if(!$model->login($request)) {
                var_dump($model->errors);
            }
            return $this->redirect('index');
        }
        return $this->render('login', compact('model'));
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect('login');
    }

}