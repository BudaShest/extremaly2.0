<?php

namespace app\modules\admin\controllers;

use app\modules\admin\components\ErrorHelper;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Advantage;
use app\modules\admin\components\FileWorker;
use yii\web\NotFoundHttpException;
use Yii;

class AdvantageController extends Controller
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
            'query' => Advantage::find(),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('index', compact('dataProvider'));
    }

    public function actionUpdate(int $id)
    {
        $model = $this->loadModel($id);
        if ($model->load(Yii::$app->request->post())) {
            if (!$model->save()) {
                Yii::$app->session->setFlash('error', ErrorHelper::format($model->errors));
                return $this->redirect(Yii::$app->request->referrer);
            } else {
                Yii::$app->session->setFlash('success', 'Модель была успешно обновлена!');
            }
            return $this->redirect('/admin/advantage/view?id=' . $model->id);
        }
        return $this->render('create', ['model' => $model]);
    }

    public function actionCreate()
    {
        $model = new Advantage();
        if ($model->load(Yii::$app->request->post())) {
            if (!$model->save()) {
                Yii::$app->session->setFlash('error', ErrorHelper::format($model->errors));
                return $this->redirect(Yii::$app->request->referrer);
            } else {
                Yii::$app->session->setFlash('success', 'Модель была успешно добавлена!');
            }
            return $this->redirect('/admin/advantage/view?id=' . $model->id);
        }
        return $this->render('create', ['model' => $model]);
    }

    public function actionDelete(int $id)
    {
        $model = $this->loadModel($id);
        if (!$model->delete()) {
            Yii::$app->session->setFlash('error', 'Модель не была удалена!');
        } else {
            Yii::$app->session->setFlash('success', 'Модель была успешно удалена!');
        }
        return $this->redirect('/admin/advantage');
    }


    public function actionView(int $id)
    {
        $model = $this->loadModel($id);
        return $this->render('detail', compact('model'));
    }

    protected function loadModel(int $id)
    {
        if (!$model = Advantage::findOne($id)) {
            throw new NotFoundHttpException("Статический контент не найден!");
        }
        return $model;
    }
}
