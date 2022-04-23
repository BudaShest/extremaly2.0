<?php

namespace app\modules\admin\controllers;

use app\modules\admin\components\ErrorHelper;
use Prophecy\Argument\Token\ExactValueToken;
use yii\web\Response;
use app\modules\admin\models\EventReview;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use Yii;

class EventReviewController extends Controller
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

    /**
     * Страница со списком всех комментариев к событию
     * @return string
     */
    public function actionIndex(): string
    {
        $eventReviewsProvider = new ActiveDataProvider([
            'query' => EventReview::find(),
            'pagination' => [
                'pageSize' => 10
            ]
        ]);
        return $this->render('index', compact('eventReviewsProvider'));
    }

    /**
     * Страница обновления информации комментария к событию
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
            return $this->redirect('/admin/event-review/view?id=' . $model->id);
        }
        return $this->render('create', ['eventReview' => $model]);
    }

    /**
     * Удаление записи комментария к событию
     * @param string $id
     * @return Response
     * @throws NotFoundHttpException
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete(string $id): Response
    {
        $model = $this->loadModel($id);
        if (!$model->delete()) {
            Yii::$app->session->setFlash('error', 'Модель не была удалена!');
        } else {
            Yii::$app->session->setFlash('success', 'Модель была успешно удалена!');
        }
        return $this->redirect('/admin/event-review');
    }

    /**
     * Страница просмотра детальной информации комментария к событию
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
     * @return EventReview
     * @throws NotFoundHttpException
     */
    protected function loadModel(int $id): EventReview
    {
        if (!$model = EventReview::findOne($id)) {
            throw new NotFoundHttpException('Модель не найдена!');
        }
        return $model;
    }
}
