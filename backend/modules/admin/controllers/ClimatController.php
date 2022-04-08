<?php

namespace app\modules\admin\controllers;

use app\modules\admin\components\ErrorHelper;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\modules\admin\models\Climat;
use yii\web\NotFoundHttpException;
use app\modules\admin\components\FileWorker;
use yii\data\ActiveDataProvider;
use Yii;
use yii\helpers\ArrayHelper;

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
        $model = $this->loadModel($code);
        $fileWorker = new FileWorker(compact('model'));
        if ($model->load(Yii::$app->request->post())) {
            if ($fileWorker->attachFile()) {
                $fileWorker->deleteFiles();
                if (!$fileWorker->upload()) {
                    Yii::$app->session->setFlash('error', 'Ошибка загрузки файла');
                }
            }
            if (!$model->save()) {
                Yii::$app->session->setFlash('error', ErrorHelper::format($model->errors));
                return $this->redirect(Yii::$app->request->referrer);
            } else {
                Yii::$app->session->setFlash('success', 'Модель была успешно обновлена!');
            }
            return $this->redirect('/admin/climat/view?code=' . $model->code);
        }
        return $this->render('create', ['climat' => $model]);
    }

    public function actionCreate()
    {
        $model = new Climat();
        $fileWorker = new FileWorker(compact('model'));
        if ($model->load(Yii::$app->request->post())) {
            if ($fileWorker->attachFile()) {
                if (!$fileWorker->upload()) {
                    Yii::$app->session->setFlash('error', 'Ошибка загрузки файла');
                }
            }
            if (!$model->save()) {
                Yii::$app->session->setFlash('error', ErrorHelper::format($model->errors));
                return $this->redirect(Yii::$app->request->referrer);
            } else {
                Yii::$app->session->setFlash('success', 'Модель была успешно добавлена!');
            }
            return $this->redirect('/admin/climat/view?code=' . $model->code);
        }
        return $this->render('create', ['climat' => $model]);
    }

    public function actionDelete(string $code)
    {
        $model = $this->loadModel($code);
        $fileWorker = new FileWorker(['model' => $model]);
        $fileWorker->deleteFiles();
        if (!$model->delete()) {
            Yii::$app->session->setFlash('error', 'Модель не была удалена!');
        } else {
            Yii::$app->session->setFlash('success', 'Модель была успешно удалена!');
        }
        return $this->redirect('/admin/climat');
    }


    public function actionView(string $code)
    {
        $model = $this->loadModel($code);
        return $this->render('detail', compact('model'));
    }

    public function actionDeleteFiles(string $code)
    {
        $model = $this->loadModel($code);
        $fileWorker = new FileWorker(compact('model'));
        if (!$fileWorker->deleteFiles()) {
            Yii::$app->session->setFlash('error', 'Файлы не были удалены');
        }
        return $this->redirect('/admin/climat/view?code=' . $model->code);
    }

    protected function loadModel(string $code)
    {
        if (!$model = Climat::findOne(['code' => $code])) {
            throw new NotFoundHttpException(Climat::MODEL_NAME_RU . ' не найден!');
        }
        return $model;
    }
}