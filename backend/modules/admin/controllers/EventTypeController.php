<?php

namespace app\modules\admin\controllers;

use app\modules\admin\components\FileWorker;
use yii\web\Controller;
use app\modules\admin\models\EventType;
use yii\data\ActiveDataProvider;
use Yii;
use yii\web\NotFoundHttpException;

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
        $model = $this->loadModel($id);
        $fileWorker = new FileWorker(compact('model'));
        if($model->load(Yii::$app->request->post())){
            if(!$fileWorker->attachFile() || !$fileWorker->upload()){
                Yii::$app->session->setFlash('Ошибка созранения файла');
            }else{
                $fileWorker->deleteFiles();
            }
            if (!$model->save()){
                var_dump($model->errors);die;
            }
            return $this->redirect(Yii::$app->request->referrer);
        }
        return $this->render('create', ['eventType' => $model]);
    }

    public function actionDelete(int $id)
    {
        $model = $this->loadModel($id);
        $model->delete();
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionCreate()
    {
        $model = new EventType();
        $fileWorker = new FileWorker(compact('model'));
        if($model->load(Yii::$app->request->post())){
            if(!$fileWorker->attachFile() || !$fileWorker->upload()){
                Yii::$app->session->setFlash('success','Ошибка загрузки файлов');
            }
            if(!$model->save()){
                var_dump($model->errors);die;
            }
            return $this->redirect(Yii::$app->request->referrer);
        }
        return $this->render('create', ['eventType' => $model]);
    }

    public function actionView(int $id)
    {
        $model = $this->loadModel($id);
        return $this->render('detail', compact('model'));
    }

    protected function loadModel(int $id)
    {
        if(!$model = EventType::findOne($id)){
            throw new NotFoundHttpException('Модель не найдена!');
        }
        return $model;
    }
}