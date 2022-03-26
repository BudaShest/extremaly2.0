<?php

namespace app\modules\admin\controllers;

use app\modules\admin\components\FileWorker;
use yii\web\Controller;
use app\modules\admin\models\Country;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use Yii;

class CountryController extends Controller
{
    public function actionIndex()
    {
        $countriesProvider = new ActiveDataProvider([
            'query' => Country::find(),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('index', compact('countriesProvider'));
    }

    public function actionDelete(string $code)
    {
        $model = $this->loadModel($code);
        $model->delete();
        $this->redirect(Yii::$app->request->referrer);
    }

    public function actionUpdate(string $code)
    {
        $model = $this->loadModel($code);
        $fileWorker = new FileWorker(compact('model'));
        if($model->load(Yii::$app->request->post())){
            $fileWorker->deleteFiles();
            if(!$fileWorker->attachFile() || !$fileWorker->upload()){
                Yii::$app->session->setFlash('error','Ошибка загрузки файлов');
            }
            if(!$model->save()){
                var_dump($model->errors);die;
            }
            return $this->redirect(Yii::$app->request->referrer);
        }
        return $this->render('create', ['country' => $model]);
    }

    public function actionCreate()
    {
        $model = new Country();
        $fileWorker = new FileWorker(compact('model'));
        if($model->load(Yii::$app->request->post())){
            if(!$fileWorker->attachFile() || !$fileWorker->upload()){
                Yii::$app->session->setFlash('error','Ошибка загрузки файлов');
            }
            if(!$model->save()){
                var_dump($model->errors);die;
            }
            return $this->redirect(Yii::$app->request->referrer);
        }
        return $this->render('create', ['country' => $model]);
    }

    public function actionView(string $code){
        $model = $this->loadModel($code);
        return $this->render('detail', compact('model'));
    }

    protected function loadModel(string $code): Country
    {
        if(!$model = Country::findOne($code)){
            throw new NotFoundHttpException('Страна не найдена!');
        }
        return $model;
    }

}