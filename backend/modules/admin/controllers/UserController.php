<?php

namespace app\modules\admin\controllers;

use app\models\Banned;
use app\modules\admin\models\EventReview;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\web\Controller;
use app\modules\admin\models\User;
use yii\web\NotFoundHttpException;
use app\modules\admin\models\Application;
use yii\data\ActiveDataProvider;
use Yii;

class UserController extends Controller
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
                        'actions' => ['index', 'ban', 'unban', 'delete', 'view'],
                        'roles' => ['@'],
                    ]
                ],
                'denyCallback' => function(){
                    return $this->redirect('main/login');
                },
            ]
        ];
    }

    /**
     * Загрузка модели
     * @param int $id
     * @return User
     * @throws NotFoundHttpException
     */
    protected function loadModel(int $id): User
    {
        if (!$model = User::findOne($id)) {
            throw new NotFoundHttpException('Модель не найдена');
        }
        return $model;
    }

    /**
     * Страница со списком всех пользователей
     * @return string
     */
    public function actionIndex(): string
    {
        $model = new User();
        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
            'pagination' => [
                'pageSize' => 10
            ]
        ]);

        return $this->render('index', compact('dataProvider', 'model'));
    }

    /**
     * Удаление пользовательской записи
     * @param int $id
     * @return Response
     * @throws NotFoundHttpException
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete(int $id): Response
    {
        $model = $this->loadModel($id);
        if ($model->delete()) {
            Yii::$app->session->setFlash('success', 'Пользователь был успешно удалён');
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Страница просмотра пользовательской информации
     * @param int $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView(int $id): string
    {
        $model = $this->loadModel($id);
        $eventReviewsProvider = new ActiveDataProvider([
            'query' => EventReview::find()->where(['user_id'=>$model->id]),
            'pagination' => [
                'pageSize' => 10
            ]
        ]);
        $applicationProvider = new ActiveDataProvider([
            'query' => Application::find()->where(['user_id'=>$model->id]),
            'pagination' => [
                'pageSize' => 10
            ]
        ]);
        return $this->render('detail', compact('model','eventReviewsProvider','applicationProvider'));
    }

    /**
     * Забанить пользователя
     * @param int $id
     * @return Response
     * @throws \yii\db\Exception
     */
    public function actionBan(int $id): Response
    {
        $model = User::findIdentity($id);
        $banned = new Banned();
        $model->link('banned', $banned);
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Разбанить пользователя
     * @param int $id
     * @return Response
     * @throws \yii\db\StaleObjectException
     */
    public function actionUnban(int $id): Response
    {
        if ($model = Banned::findOne(['user_id' => $id])) {
            $model->delete();
        } else {
            Yii::$app->session->setFlash('error', 'Ошибка разбана');
        }

        return $this->redirect(Yii::$app->request->referrer);
    }
}
