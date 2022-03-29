<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;
use app\modules\admin\models\User;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;

class UserController extends Controller
{
    protected function loadModel(int $id)
    {
        if(!$model = User::findOne($id)){
            throw new NotFoundHttpException('Модель не найдена');
        }
        return $model;
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
            'pagination' => [
                'pageSize' => 10
            ]
        ]);

        return $this->render('index', compact('dataProvider'));
    }
}