<?php

namespace app\modules\admin\controllers;

use app\models\Person;
use app\modules\admin\components\ErrorHelper;
use app\modules\admin\components\FileWorker;
use Yii;
use app\modules\admin\models\EventType;
use app\modules\admin\models\Place;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use app\modules\admin\models\Event;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class EventController extends Controller
{
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'update', 'create', 'delete', 'view', 'delete-files', 'add-persons'],
                        'roles' => ['@'],
                    ]
                ],
                'denyCallback' => function () {
                    return $this->redirect('main/login');
                },
            ],
        ];
    }

    /**
     * Загрузка модели
     * @param int $id
     * @return Event
     * @throws NotFoundHttpException
     */
    protected function loadModel(int $id): Event
    {
        if (!$model = Event::findOne($id)) {
            throw new NotFoundHttpException();
        }
        return $model;
    }

    /**
     * Страница со списком всех событий
     * @return string
     */
    public function actionIndex(): string
    {
        $model = new Event();
        return $this->render('index', compact('model'));
    }

    /**
     * Страница добавления события
     * @return string|void|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Event();
        $eventType = new EventType();
        $fileWorker = new FileWorker(compact('model'));
        $eventTypeFileWorker = new FileWorker(['model' => $eventType]);
        if ($model->load(Yii::$app->request->post())) {
            if (!$model->save()) {
                Yii::$app->session->setFlash('error', ErrorHelper::format($model->errors));
                return $this->redirect(Yii::$app->request->referrer);
            } else {
                Yii::$app->session->setFlash('success', 'Модель была успешно добавлена!');
            }
            if ($fileWorker->attachFiles()) {
                if (!$fileWorker->upload()) {
                    Yii::$app->session->setFlash('error', 'Ошибка загрузки файла');
                }
            }
            return $this->redirect('/admin/event/view?id=' . $model->id);
        }
        if ($eventType->load(Yii::$app->request->post())) {
            if ($eventTypeFileWorker->attachFile()) {
                if (!$eventTypeFileWorker->upload()) {
                    Yii::$app->session->setFlash('error', 'Ошибка загрузки файла');
                }
            }
            if (!$eventType->save()) {
                var_dump($eventType->errors);
                die;
            } else {
                Yii::$app->session->setFlash('success', 'Модель была успешно добавлена!');
            }
            return $this->redirect('/admin/event/view?id=' . $eventType->id);
        }
        return $this->render('create', compact('model', 'eventType'));
    }

    /**
     * Страница обновления информации о событии
     * @param int $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate(int $id)
    {
        $model = $this->loadModel($id);
        $type = new EventType();
        $place = new Place();
        $fileWorker = new FileWorker(compact('model'));
        if ($model->load(Yii::$app->request->post())) {
            if (!$model->save()) {
                Yii::$app->session->setFlash('error', ErrorHelper::format($model->errors));
                return $this->redirect(Yii::$app->request->referrer);
            } else {
                Yii::$app->session->setFlash('success', 'Модель была успешно обновлена!');
            }
            if ($fileWorker->attachFiles()) {
                $fileWorker->deleteFiles();
                if (!$fileWorker->upload()) {
                    Yii::$app->session->setFlash('error', 'Ошибка загрузки файла');
                }
            }
            return $this->redirect('/admin/event/view?id=' . $model->id);
        }
        return $this->render('create', compact('model', 'type', 'place'));
    }

    /**
     * Страница просмотра события
     * @param int $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView(int $id): string
    {
        $model = $this->loadModel($id);
        $personsProvider = new ActiveDataProvider([
            'query' => Person::find()->joinWith('events')->where(['event.id' => $model->id]),
            'pagination' => [
                'pageSize' => 10
            ]
        ]);
        return $this->render('detail', compact('model', 'personsProvider'));
    }

    /**
     * Страница прикрепления пользователей к событию
     * @param int $id
     * @return string|Response
     * @throws NotFoundHttpException
     */
    public function actionAddPersons(int $id)
    {
        $model = $this->loadModel($id);
        if ($request = Yii::$app->request->post()) {
            foreach ($request['Event']['place_id'] as $personId) {
                if (!$personModel = Person::findOne($personId)) {
                    continue;
                } else {
                    $model->link('persons', $personModel);
                }
            }
            return $this->redirect('/admin/event/view?id=' . $model->id);
        }
        return $this->render('addPersons', compact('model'));
    }

    /**
     * Удаление записи события
     * @param int $id
     * @return Response
     * @throws NotFoundHttpException
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete(int $id)
    {
        $model = $this->loadModel($id);
        $fileWorker = new FileWorker(['model' => $model]);
        $fileWorker->deleteFiles();
        if (!$model->delete()) {
            Yii::$app->session->setFlash('error', 'Модель не была удалена!');
        } else {
            Yii::$app->session->setFlash('success', 'Модель была успешно удалена!');
        }
        return $this->redirect('/admin/event');
    }

    /**
     * Удаление медиафайлов
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
        return $this->redirect('/admin/event/view?id=' . $model->id);
    }
}
