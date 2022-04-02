<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;
use app\models\User;
use Yii;

class MainController extends Controller
{
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
        $model = new User();
        if($request = Yii::$app->request->post()){
            if(!$model->login($request)) {
                var_dump($model->errors);
            }
            return $this->redirect(Yii::$app->request->referrer);
        }
        return $this->render('login', compact('model'));
    }

}