<?php

namespace app\modules\admin\controllers;

use app\modules\admin\components\ErrorHelper;
use app\modules\admin\components\FileWorker;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\modules\admin\models\EventType;
use yii\data\ActiveDataProvider;
use yii\web\Response;
use Yii;
use yii\web\NotFoundHttpException;

class EventTypeController extends Controller
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
     * Страница с просмотром всех типов событий
     * @return string
     */
    public function actionIndex(): string
    {
        $eventTypesProvider = new ActiveDataProvider([
            'query' => EventType::find(),
            'pagination' => [
                'pageSize' => 10
            ]
        ]);
        return $this->render('index', compact('eventTypesProvider'));
    }

    /**
     * Страница обновления информации о типе события
     * @param int $id
     * @return string|Response
     * @throws NotFoundHttpException
     */
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
                Yii::$app->session->setFlash('error', ErrorHelper::format($model->errors));
                return $this->redirect(Yii::$app->request->referrer);
            } else {
                Yii::$app->session->setFlash('success', 'Модель была успешно обновлена!');
            }
            return $this->redirect('/admin/event-type/view?id=' . $model->id);
        }
        return $this->render('create', ['eventType' => $model]);
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
        $fileWorker = new FileWorker(['model' => $model]);
        $fileWorker->deleteFiles();
        if (!$model->delete()) {
            Yii::$app->session->setFlash('error', 'Модель не была удалена!');
        } else {
            Yii::$app->session->setFlash('success', 'Модель была успешно удалена!');
        }
        return $this->redirect('/admin/event-type');
    }

    /**
     * Страница добавления типов событий
     * @return string|Response
     */
    public function actionCreate()
    {
        $model = new EventType();
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
            return $this->redirect('/admin/event-type/view?id=' . $model->id);
        }
        return $this->render('create', ['eventType' => $model]);
    }

    /**
     * Страница просмотра детальной информации о типе события
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
     * Страница удаления медиафайлов
     * @param int $id
     * @return Response
     * @throws NotFoundHttpException
     */
    public function actionDeleteFiles(int $id): Response
    {
        $model = $this->loadModel($id);
        $fileWorker = new FileWorker(compact('model'));
        if (!$fileWorker->deleteFiles()) {
            Yii::$app->session->setFlash('error', 'Файлы не были удалены');
        }
        return $this->redirect('/admin/event-type/view?id=' . $model->id);
    }

    /**
     * Загрузка модели
     * @param int $id
     * @return EventType
     * @throws NotFoundHttpException
     */
    protected function loadModel(int $id): EventType
    {
        if (!$model = EventType::findOne($id)) {
            throw new NotFoundHttpException('Модель не найдена!');
        }
        return $model;
    }
}
