<?php

namespace app\modules\admin\controllers;

use app\models\Banned;
use app\modules\admin\models\EventReview;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\modules\admin\models\User;
use yii\web\NotFoundHttpException;
use app\modules\admin\models\Application;
use yii\data\ActiveDataProvider;
use Yii;

class UserController extends Controller
{
    public function behaviors()
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

    protected function loadModel(int $id)
    {
        if (!$model = User::findOne($id)) {
            throw new NotFoundHttpException('Модель не найдена');
        }
        return $model;
    }

    public function actionIndex()
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

    public function actionDelete(int $id)
    {
        $model = $this->loadModel($id);
        if ($model->delete()) {
            Yii::$app->session->setFlash('success', 'Пользователь был успешно удалён');
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionView(int $id)
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

    public function actionBan(int $id)
    {
        $model = User::findIdentity($id);
        $banned = new Banned();
        $model->link('banned', $banned);
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionUnban(int $id)
    {
        if ($model = Banned::findOne(['user_id' => $id])) {
            $model->delete();
        } else {
            Yii::$app->session->setFlash('error', 'Ошибка разбана');
        }

        return $this->redirect(Yii::$app->request->referrer);
    }
}