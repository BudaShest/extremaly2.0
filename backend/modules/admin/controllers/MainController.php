<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\LoginForm;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\modules\admin\components\ErrorHelper;
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
                Yii::$app->session->setFlash('error', ErrorHelper::format($model->errors));
                return $this->redirect(Yii::$app->request->referrer);
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