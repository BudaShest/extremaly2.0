<?php

namespace app\modules\admin\controllers;

use app\modules\admin\components\FileWorker;
use app\modules\admin\models\EventReview;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use Yii;

class EventReviewController extends Controller
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
        $eventReviewsProvider = new ActiveDataProvider([
            'query' => EventReview::find(),
            'pagination' => [
                'pageSize' => 10
            ]
        ]);
        return $this->render('index', compact('eventReviewsProvider'));
    }

    public function actionUpdate(int $id)
    {
        $model = $this->loadModel($id);
        if ($model->load(Yii::$app->request->post())) {
            if (!$model->save()) {
                var_dump($model->errors);
                die;
            } else {
                Yii::$app->session->setFlash('success', 'Модель была успешно обновлена!');
            }
            return $this->redirect('/admin/event-review/view?id=' . $model->id);
        }
        return $this->render('create', ['eventReview' => $model]);
    }

    public function actionDelete(string $id)
    {
        $model = $this->loadModel($id);
        if (!$model->delete()) {
            Yii::$app->session->setFlash('error', 'Модель не была удалена!');
        } else {
            Yii::$app->session->setFlash('success', 'Модель была успешно удалена!');
        }
        return $this->redirect('/admin/event-review');
    }


    public function actionView(int $id)
    {
        $model = $this->loadModel($id);
        return $this->render('detail', compact('model'));
    }


    protected function loadModel(int $id)
    {
        if (!$model = EventReview::findOne($id)) {
            throw new NotFoundHttpException('Модель не найдена!');
        }
        return $model;
    }
}