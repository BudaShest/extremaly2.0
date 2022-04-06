<?php

namespace app\modules\admin\controllers;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\StaticContent;
use app\modules\admin\components\FileWorker;
use Yii;
use yii\web\NotFoundHttpException;

class StaticContentController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'update', 'create', 'delete', 'view', 'delete-files'],
                        'roles' => ['@'],
                    ]
                ],
                'denyCallback' => function () {
                    return $this->redirect('/admin/main/login');
                },
            ]
        ];
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => StaticContent::find(),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('index', compact('dataProvider'));
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
            return $this->redirect('/admin/static-content/view?id=' . $model->id);
        }
        return $this->render('create', ['model' => $model]);
    }

    public function actionCreate()
    {
        $model = new StaticContent();
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
            return $this->redirect('/admin/static-content/view?id=' . $model->id);
        }
        return $this->render('create', ['model' => $model]);
    }

    public function actionDelete(int $id)
    {
        $model = $this->loadModel($id);
        $fileWorker = new FileWorker(['model' => $model]);
        $fileWorker->deleteFiles();
        if (!$model->delete()) {
            Yii::$app->session->setFlash('error', 'Модель не была удалена!');
        } else {
            Yii::$app->session->setFlash('success', 'Модель была успешно удалена!');
        }
        return $this->redirect('/admin/static-content');
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
        return $this->redirect('/admin/static-content/view?id=' . $model->id);
    }

    protected function loadModel(int $id)
    {
        if (!$model = StaticContent::findOne($id)) {
            throw new NotFoundHttpException("Статический контент не найден!");
        }
        return $model;
    }
}