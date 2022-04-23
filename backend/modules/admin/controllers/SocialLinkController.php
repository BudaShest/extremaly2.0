<?php

namespace app\modules\admin\controllers;
use app\modules\admin\components\ErrorHelper;
use yii\web\Controller;
use app\modules\admin\components\FileWorker;
use Yii;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\SocialLink;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class SocialLinkController extends Controller
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
     * Страница со списком соц. сетей проекта
     * @return string
     */
    public function actionIndex(): string
    {
        $dataProvider = new ActiveDataProvider([
            'query' => SocialLink::find(),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('index', compact('dataProvider'));
    }

    /**
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
            return $this->redirect('/admin/social-link/view?id=' . $model->id);
        }
        return $this->render('create', ['model' => $model]);
    }

    /**
     * Страница добавления соц. сети проекта
     * @return string|Response
     */
    public function actionCreate()
    {
        $model = new SocialLink();
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
            return $this->redirect('/admin/social-link/view?id=' . $model->id);
        }
        return $this->render('create', ['model' => $model]);
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
        $fileWorker = new FileWorker(['model' => $model]);
        $fileWorker->deleteFiles();
        if (!$model->delete()) {
            Yii::$app->session->setFlash('error', 'Модель не была удалена!');
        } else {
            Yii::$app->session->setFlash('success', 'Модель была успешно удалена!');
        }
        return $this->redirect('/admin/social-link');
    }

    /**
     * Страница просмотра информации о соц. сети проекта
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
        return $this->redirect('/admin/social-link/view?id=' . $model->id);
    }

    /**
     * Загрузка модели
     * @param int $id
     * @return SocialLink
     * @throws NotFoundHttpException
     */
    protected function loadModel(int $id): SocialLink
    {
        if (!$model = SocialLink::findOne($id)) {
            throw new NotFoundHttpException("Статический контент не найден!");
        }
        return $model;
    }
}
