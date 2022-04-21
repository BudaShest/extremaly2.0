<?php

namespace app\modules\admin\controllers;

use app\modules\admin\components\ErrorHelper;
use app\modules\admin\models\PersonLink;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\web\Response;
use app\modules\admin\components\FileWorker;
use Yii;
use yii\web\NotFoundHttpException;

class PersonLinkController extends Controller
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

    /**
     * Страница со списком соц. сетей личностей
     * @return string
     */
    public function actionIndex(): string
    {
        $personLinksProvider = new ActiveDataProvider([
            'query' => PersonLink::find(),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('index', compact('personLinksProvider'));
    }

    /**
     * Страница обновления соц. сети личности
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
            return $this->redirect('/admin/person-link/view?id=' . $model->id);
        }
        return $this->render('create', ['model' => $model]);
    }

    /**
     * Страница создания соц. сети личности
     * @return string|Response
     */
    public function actionCreate()
    {
        $model = new PersonLink();
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
            return $this->redirect('/admin/person-link/view?id=' . $model->id);
        }
        return $this->render('create', ['model' => $model]);
    }

    /**
     * Удаление личности
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
        return $this->redirect('/admin/person-link');
    }

    /**
     * Страница просмотра детальной информации о соц. сети личности
     * @param int $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView(int $id)
    {
        $model = $this->loadModel($id);
        return $this->render('detail', compact('model'));
    }

    /**
     * Удаление медиафайлов соц. сети личности
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
        return $this->redirect('/admin/person-link/view?id=' . $model->id);
    }

    /**
     * Загрузка модели
     * @param int $id
     * @return PersonLink
     * @throws NotFoundHttpException
     */
    protected function loadModel(int $id): PersonLink
    {
        if (!$model = PersonLink::findOne($id)) {
            throw new NotFoundHttpException("Статический контент не найден!");
        }
        return $model;
    }
}
