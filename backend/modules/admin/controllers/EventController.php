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
                ],
                'denyCallback' => function(){
                    return $this->redirect('main/login');
                },
            ],
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
        $eventType = new EventType();
        $fileWorker = new FileWorker(compact('model'));
        $eventTypeFileWorker = new FileWorker(['model' => $eventType]);
        if($model->load(Yii::$app->request->post())){
            if(!$model->save()){
                var_dump($model->errors);die;
            }else{
                Yii::$app->session->setFlash('success','Модель была успешно добавлена!');
            }
            if ($fileWorker->attachFiles()) {
                if(!$fileWorker->upload()){
                    Yii::$app->session->setFlash('error', 'Ошибка загрузки файла');
                }
            }
            return $this->redirect('/admin/event/view?id='.$model->id);
        }
        if($eventType->load(Yii::$app->request->post())){
            if ($eventTypeFileWorker->attachFile()) {
                if (!$eventTypeFileWorker->upload()) {
                    Yii::$app->session->setFlash('error', 'Ошибка загрузки файла');
                }
            }
            if (!$eventType->save()) {
                var_dump($eventType->errors);die;
            } else {
                Yii::$app->session->setFlash('success', 'Модель была успешно добавлена!');
            }
            return $this->redirect('/admin/place/view?id'.$place->id);
        }
        return $this->render('create', compact('model', 'eventType'));
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
            }else{
                Yii::$app->session->setFlash('success','Модель была успешно обновлена!');
            }
            if ($fileWorker->attachFiles()) {
                $fileWorker->deleteFiles();
                if(!$fileWorker->upload()){
                    Yii::$app->session->setFlash('error', 'Ошибка загрузки файла');
                }
            }
            return $this->redirect('/admin/event/view?id='.$model->id);
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
        $fileWorker = new FileWorker(['model' => $model]);
        $fileWorker->deleteFiles();
        if(!$model->delete()){
            Yii::$app->session->setFlash('error', 'Модель не была удалена!');
        }else{
            Yii::$app->session->setFlash('success', 'Модель была успешно удалена!');
        }
        return $this->redirect('/admin/event');
    }

}