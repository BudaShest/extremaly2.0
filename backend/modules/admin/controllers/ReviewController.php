<?php

namespace app\modules\admin\controllers;

use app\modules\admin\components\ErrorHelper;
use app\modules\admin\components\FileWorker;
use app\modules\admin\models\Review;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use Yii;

class ReviewController extends Controller
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
        $reviewsProvider = new ActiveDataProvider([
            'query' =>Review::find(),
            'pagination' => [
                'pageSize' => 10
            ]
        ]);
        return $this->render('index', compact('reviewsProvider'));
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
            return $this->redirect('/admin/review/view?id=' . $model->id);
        }
        return $this->render('create', ['eventType' => $model]);
    }

    public function actionDelete(string $id)
    {
        $model = $this->loadModel($id);
        if (!$model->delete()) {
            Yii::$app->session->setFlash('error', 'Модель не была удалена!');
        } else {
            Yii::$app->session->setFlash('success', 'Модель была успешно удалена!');
        }
        return $this->redirect('/admin/review');
    }


    public function actionView(int $id)
    {
        $model = $this->loadModel($id);
        return $this->render('detail', compact('model'));
    }


    protected function loadModel(int $id)
    {
        if (!$model = Review::findOne($id)) {
            throw new NotFoundHttpException('Модель не найдена!');
        }
        return $model;
    }
}
