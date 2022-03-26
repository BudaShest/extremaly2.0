<?php

namespace app\modules\admin\controllers;

use yii\base\Model;
use yii\web\Controller;
use app\modules\admin\models\EventType;
use yii\data\ActiveDataProvider;
use yii

class EventTypeController extends Controller
{
    public function actionIndex()
    {
//        $model = new EventType();
        $eventTypesProvider = new ActiveDataProvider([
           'query' => EventType::find(),
            'pagination' => [
                'pageSize' => 10
            ]
        ]);
        return $this->render('index', compact('eventTypesProvider'));
    }

    public function actionUpdate(int $id)
    {

    }

    public function actionDelete(int $id)
    {

    }

    public function actionCreate()
    {
        $model = new Model();
        if($model->load(Yii::$app->request->post())){

        }
    }

    public function actionView(int $id)
    {

    }

    protected function loadModel(int $id)
    {

    }
}