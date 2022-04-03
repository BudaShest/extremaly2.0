<?php

namespace app\modules\admin\controllers;

use app\modules\admin\components\FileWorker;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\modules\admin\models\Person;
use yii\web\NotFoundHttpException;
use Yii;

class PersonController extends Controller
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
            return $this->redirect('/admin/person/view?id='.$model->id);
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
            }else{
                Yii::$app->session->setFlash('success','Модель была успешно добавлена!');
            }
            if ($fileWorker->attachFiles()) {
                if(!$fileWorker->upload()){
                    Yii::$app->session->setFlash('error', 'Ошибка загрузки файла');
                }
            }
            return $this->redirect('/admin/person/view?id='.$model->id);
        }
        return $this->render('create', compact('model'));
    }

    public function actionDelete(string $id)
    {
        $model = $this->loadModel($id);
        $fileWorker = new FileWorker(['model' => $model]);
        $fileWorker->deleteFiles();
        if(!$model->delete()){
            Yii::$app->session->setFlash('error', 'Модель не была удалена!');
        }else{
            Yii::$app->session->setFlash('success', 'Модель была успешно удалена!');
        }
        return $this->redirect('/admin/person');
    }
}