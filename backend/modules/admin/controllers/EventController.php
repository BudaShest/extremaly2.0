<?php

namespace app\modules\admin\controllers;

use app\modules\admin\components\FileWorker;
use Yii;
use app\modules\admin\models\EventType;
use app\modules\admin\models\Place;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\modules\admin\models\Event;
use yii\web\NotFoundHttpException;

class EventController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'update', 'create', 'delete', 'view'],
                        'roles' => ['@'],
                    ]
                ]
            ]
        ];
    }

    protected function loadModel(int $id){
        if(!$model = Event::findOne($id)){
            throw new NotFoundHttpException();
        }
        return $model;
    }

    public function actionIndex()
    {
        $model = new Event();
        return $this->render('index', compact('model'));
    }

    public function actionCreate()
    {
        $model = new Event();
        $type = new EventType();
        $place = new Place();
        $fileWorker = new FileWorker(compact('model'));
        if($model->load(Yii::$app->request->post())){
            if(!$model->save()){
                var_dump($model->errors);die;
            }
            if(!$fileWorker->attachFiles() || !$fileWorker->upload()){
                Yii::$app->session->setFlash('Ошибка загрузки файла!');
            }
            return $this->redirect(Yii::$app->request->referrer);
        }
        return $this->render('create', compact('model', 'type', 'place'));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        $type = new EventType();
        $place = new Place();
        $fileWorker = new FileWorker(compact('model'));
        if($model->load(Yii::$app->request->post())){
            if(!$model->save()){
                var_dump($model->errors);die;
            }
            if(!$fileWorker->attachFiles() || !$fileWorker->upload()){
                Yii::$app->session->setFlash('Ошибка загрузки файла!');
            }else{
                $fileWorker->deleteFiles();
            }
            return $this->redirect(Yii::$app->request->referrer);
        }
        return $this->render('create', compact('model', 'type', 'place'));
    }

    public function actionView($id)
    {
        $model = $this->loadModel($id);
        return $this->render('detail', compact('model'));
    }

    public function actionDelete($id)
    {
        $model = $this->loadModel($id);
        $model->delete();
        return $this->redirect(Yii::$app->request->referrer);
    }

}