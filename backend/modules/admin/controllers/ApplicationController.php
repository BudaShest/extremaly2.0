<?php

namespace app\modules\admin\controllers;

use yii\web\Response;
use app\modules\admin\components\ErrorHelper;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\modules\admin\models\Application;
use yii\web\NotFoundHttpException;
use Yii;

class ApplicationController extends Controller
{
    /** @inheritDoc */
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
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
     * Страница со списком всех заявок
     * @return string
     */
    public function actionIndex(): string
    {
        $applicationProvider = new ActiveDataProvider([
            'query' => Application::find(),
            'pagination' => [
                'pageSize' => 10,
            ]
        ]);

        return $this->render('index', compact('applicationProvider'));
    }

    /**
     * Страница обновления статуса заявки
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
            }
            Yii::$app->mailer->compose()
                ->setFrom('rsx99@mail.ru')
                ->setTo(Yii::$app->user->identity->email ?? 'rsx99@mail.ru')
                ->setSubject('Смена статуса заявки')
                ->setTextBody("У заявки №{$model->id} был изменён статус на " . $model->status->name)
                ->send();


            return $this->redirect('/admin/application/');
        }
        return $this->render('create', compact('model'));
    }

    /**
     * Удаление записи
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
        return $this->redirect('/admin/application');
    }

    /**
     * Загрузка модели
     * @param int $id
     * @return Application
     * @throws NotFoundHttpException
     */
    protected function loadModel(int $id): Application
    {
        if (!$model = Application::findOne($id)) {
            throw new NotFoundHttpException("Статический контент не найден!");
        }
        return $model;
    }
}
