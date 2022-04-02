<?php

namespace app\modules\admin\controllers;

use yii\data\ActiveDataProvider;
use yii\web\Controller;
use app\modules\admin\models\Application;

class ApplicationController extends Controller
{
    public function actionIndex()
    {
        $applicationProvider = new ActiveDataProvider([
            'query' => Application::find(),
            'pagination' => [
                'pageSize' => 10,
            ]
        ]);

        return $this->render('index', compact('applicationProvider'));
    }
}