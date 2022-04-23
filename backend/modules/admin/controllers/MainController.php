<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\LoginForm;
use yii\filters\AccessControl;
use yii\web\Response;
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
    public function actions(): array
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Главная страница
     * @return string
     */
    public function actionIndex(): string
    {
        return $this->render('index');
    }

    /**
     * Страница авторизации
     * @return string|Response
     */
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

    /**
     * Выход
     * @return Response
     */
    public function actionLogout(): Response
    {
        Yii::$app->user->logout();
        return $this->redirect('login');
    }
}
