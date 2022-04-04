<?php

namespace app\modules\admin\controllers;

use app\modules\admin\components\FileWorker;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\modules\admin\models\EventType;
use yii\data\ActiveDataProvider;
use Yii;
use yii\web\NotFoundHttpException;

class EventTypeController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'update', 'create', 'delete', 'view','delete-files'],
                        'roles' => ['@'],
                    ]
                ],
                'denyCallback' => function () {
                    return $this->redirect('main/login');
                },
            ]
        ];
    }

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
        if ($model->load(Yii::$app->request->post())) {
            if ($fileWorker->attachFile()) {
                $fileWorker->deleteFiles();
                if (!$fileWorker->upload()) {
                    Yii::$app->session->setFlash('error', 'Ошибка загрузки файла');
                }
            }
            if (!$model->save()) {
                var_dump($model->errors);
                die;
            } else {
                Yii::$app->session->setFlash('success', 'Модель была успешно обновлена!');
            }
            return $this->redirect('/admin/event-type/view?id=' . $model->id);
        }
        return $this->render('create', ['eventType' => $model]);
    }

    public function actionDelete(string $id)
    {
        $model = $this->loadModel($id);
        $fileWorker = new FileWorker(['model' => $model]);
        $fileWorker->deleteFiles();
        if (!$model->delete()) {
            Yii::$app->session->setFlash('error', 'Модель не была удалена!');
        } else {
            Yii::$app->session->setFlash('success', 'Модель была успешно удалена!');
        }
        return $this->redirect('/admin/event-type');
    }

    public function actionCreate()
    {
        $model = new EventType();
        $fileWorker = new FileWorker(compact('model'));
        if ($model->load(Yii::$app->request->post())) {
            if ($fileWorker->attachFile()) {
                if (!$fileWorker->upload()) {
                    Yii::$app->session->setFlash('error', 'Ошибка загрузки файла');
                }
            }
            if (!$model->save()) {
                var_dump($model->errors);
                die;
            } else {
                Yii::$app->session->setFlash('success', 'Модель была успешно добавлена!');
            }
            return $this->redirect('/admin/event-type/view?id=' . $model->id);
        }
        return $this->render('create', ['eventType' => $model]);
    }

    public function actionView(int $id)
    {
        $model = $this->loadModel($id);
        return $this->render('detail', compact('model'));
    }

    public function actionDeleteFiles(int $id)
    {
        $model = $this->loadModel($id);
        $fileWorker = new FileWorker(compact('model'));
        if (!$fileWorker->deleteFiles()) {
            Yii::$app->session->setFlash('error', 'Файлы не были удалены');
        }
        return $this->redirect('/admin/event-type/view?id=' . $model->id);
    }

    protected function loadModel(int $id)
    {
        if (!$model = EventType::findOne($id)) {
            throw new NotFoundHttpException('Модель не найдена!');
        }
        return $model;
    }
}