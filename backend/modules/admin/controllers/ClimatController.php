<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;
use app\modules\admin\models\Climat;
use yii\web\NotFoundHttpException;
use app\modules\admin\components\FileWorker;

class ClimatController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionDelete(string $code)
    {
        if(!$model = Climat::findOne(['code' => $code])){
            throw new NotFoundHttpException(Climat::MODEL_NAME_RU . ' не найден!');
        }
        $fileWorker = new FileWorker(['model' => $model]);
        if(!$fileWorker->deleteFiles()){
            var_dump('cc');die;
            \Yii::$app->session->setFlash('error', 'Файлы модели ' . Climat::MODEL_NAME_RU . ' не были удалены');
        }
        $model->delete();
    }



    public function actionView(string $code)
    {
        if(!$model = Climat::findOne(['code' => $code])){
            throw new NotFoundHttpException(Climat::MODEL_NAME_RU . ' не найден!');
        }
        return $this->render('detail', compact('model'));
    }
}