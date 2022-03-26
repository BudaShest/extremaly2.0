<?php

namespace app\modules\admin\controllers;

use app\modules\admin\components\FileWorker;
use yii\web\Controller;
use app\modules\admin\models\Person;
use yii\web\NotFoundHttpException;
use Yii;

class PersonController extends Controller
{
    protected function loadModel(int $id)
    {
        if(!$model = Person::findOne($id)){
            throw new NotFoundHttpException('Модель Песоны не найдена');
        }
        return $model;
    }

    public function actionIndex()
    {
        $model = new Person();
        return $this->render('index');
    }

    public function actionView(int $id)
    {
        $model = $this->loadModel($id);
        return $this->render('detail', compact('model'));
    }

    public function actionUpdate(int $id)
    {
        $model = $this->loadModel($id);
        $fileWorker = new FileWorker(compact('model'));
        if($model->load(Yii::$app->request->post())){
            $fileWorker->deleteFiles();
            if(!$model->save()){
                var_dump($model->errors);die;
            }
            if(!$fileWorker->attachFiles() || !$fileWorker->upload()){
                Yii::$app->session->setFlash('error', 'Ошибка прикрепления изображений');
            }
            return $this->redirect(Yii::$app->request->referrer);
        }
        return $this->render('create', compact('model'));

    }

    public function actionCreate()
    {
        $model = new Person();
        $fileWorker = new FileWorker(compact('model'));
        if($model->load(Yii::$app->request->post())){
            if(!$model->save()){
                var_dump($model->errors);die;
            }
            if(!$fileWorker->attachFiles() || !$fileWorker->upload()){
                Yii::$app->session->setFlash('error', 'Ошибка прикрепления изображений');
            }
            return $this->redirect(Yii::$app->request->referrer);
        }
        return $this->render('create', compact('model'));
    }
}