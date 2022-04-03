<?php

namespace app\modules\admin\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;
use app\modules\admin\models\Climat;
use yii\web\NotFoundHttpException;
use app\modules\admin\components\FileWorker;
use yii\data\ActiveDataProvider;
use Yii;

class ClimatController extends Controller
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
            ]
        ];
    }

    public function actionIndex()
    {
        $climatesProvider = new ActiveDataProvider([
            'query' => Climat::find(),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('index', compact('climatesProvider'));
    }

    public function actionUpdate(string $code)
    {
        $model = $this -> loadModel($code);
        $fileWorker = new FileWorker(compact('model'));
        if($model->load(Yii::$app->request->post())){
            $fileWorker->deleteFiles();
            if(!$fileWorker->attachFile() || !$fileWorker->upload()){
                Yii::$app->session->setFlash('error', 'Ошибка загрузки файла');
            }
            if(!$model->save()){
                var_dump($model->errors);die;
            }
            return $this->redirect(Yii::$app->request->referrer);
        }
        return $this->render('create', ['climat' => $model]);
    }

    public function actionCreate()
    {
        $model = new Climat();
        $fileWorker = new FileWorker(compact('model'));
        if($model->load(Yii::$app->request->post())){
            if(!$fileWorker->attachFile() || !$fileWorker->upload()){
                Yii::$app->session->setFlash('error', 'Ошибка загрузки файла');
            }
            if(!$model->save()){
                var_dump($model->errors);die;
            }
            return $this->redirect(Yii::$app->request->referrer);
        }
        return $this->render('create', ['climat' => $model]);
    }

    public function actionDelete(string $code)
    {
        $model = $this->loadModel($code);
        $fileWorker = new FileWorker(['model' => $model]);
        if(!$fileWorker->deleteFiles()){
            \Yii::$app->session->setFlash('error', 'Файлы модели ' . Climat::MODEL_NAME_RU . ' не были удалены');
        }
        $model->delete();
        return $this->redirect(Yii::$app->request->referrer);
    }



    public function actionView(string $code)
    {
        $model = $this->loadModel($code);
        return $this->render('detail', compact('model'));
    }

    protected function loadModel(string $code)
    {
        if(!$model = Climat::findOne(['code' => $code])){
            throw new NotFoundHttpException(Climat::MODEL_NAME_RU . ' не найден!');
        }
        return $model;
    }
}