<?php

namespace app\modules\admin\controllers;

use app\modules\admin\components\ErrorHelper;
use yii\web\Response;
use app\modules\admin\models\Review;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use Yii;

class ReviewController extends Controller
{
    /** @inheritDoc */
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'update', 'delete', 'view','delete-files'],
                        'roles' => ['@'],
                    ]
                ],
                'denyCallback' => function () {
                    return $this->redirect('main/login');
                },
            ]
        ];
    }

    /**
     * Страница со списком всех отзывов о проекте
     * @return string
     */
    public function actionIndex(): string
    {
        $reviewsProvider = new ActiveDataProvider([
            'query' =>Review::find(),
            'pagination' => [
                'pageSize' => 10
            ]
        ]);
        return $this->render('index', compact('reviewsProvider'));
    }

    /**
     * Страница обновления отзыва о проекте
     * @param int $id
     * @return string|Response
     * @throws NotFoundHttpException
     */
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
        return $this->render('create', ['review' => $model]);
    }

    /**
     * @param int $id
     * @return Response
     * @throws NotFoundHttpException
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete(int $id): Response
    {
        $model = $this->loadModel($id);
        if (!$model->delete()) {
            Yii::$app->session->setFlash('error', 'Модель не была удалена!');
        } else {
            Yii::$app->session->setFlash('success', 'Модель была успешно удалена!');
        }
        return $this->redirect('/admin/review');
    }

    /**
     * Страница просмотра отзыва о проекте
     * @param int $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView(int $id): string
    {
        $model = $this->loadModel($id);
        return $this->render('detail', compact('model'));
    }

    /**
     * Загрузка модели
     * @param int $id
     * @return Review
     * @throws NotFoundHttpException
     */
    protected function loadModel(int $id): Review
    {
        if (!$model = Review::findOne($id)) {
            throw new NotFoundHttpException('Модель не найдена!');
        }
        return $model;
    }
}
