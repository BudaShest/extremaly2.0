<?php

namespace app\modules\admin\controllers;

use app\modules\admin\components\ErrorHelper;
use app\modules\admin\components\FileWorker;
use yii\web\Response;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\modules\admin\models\Country;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use yii\db\StaleObjectException;
use Yii;

class CountryController extends Controller
{
    /**
     * @inheritDoc
     * @return array[]
     */
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
     * Просмотр странииы "Все страны"
     * @return string
     */
    public function actionIndex(): string
    {
        $countriesProvider = new ActiveDataProvider([
            'query' => Country::find(),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('index', compact('countriesProvider'));
    }

    /**
     * Удаление записи страны
     * @param string $code
     * @return Response
     * @throws NotFoundHttpException
     * @throws StaleObjectException
     */
    public function actionDelete(string $code): Response
    {
        $model = $this->loadModel($code);
        $fileWorker = new FileWorker(['model' => $model]);
        $fileWorker->deleteFiles();
        if (!$model->delete()) {
            Yii::$app->session->setFlash('error', 'Модель не была удалена!');
        } else {
            Yii::$app->session->setFlash('success', 'Модель была успешно удалена!');
        }
        return $this->redirect('/admin/country');
    }

    /**
     * Обновление информации о стране
     * @param string $code
     * @return string|Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate(string $code)
    {
        $model = $this->loadModel($code);
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
            return $this->redirect('/admin/country/view?code=' . $model->code);
        }
        return $this->render('create', ['country' => $model]);
    }

    /**
     * Создание страны (Добавление информации)
     * @return string|Response
     */
    public function actionCreate()
    {
        $model = new Country();
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
            return $this->redirect('/admin/country/view?code=' . $model->code);
        }
        return $this->render('create', ['country' => $model]);
    }

    /**
     * Удаление медиафайлов страны
     * @param string $code
     * @return Response
     * @throws NotFoundHttpException
     */
    public function actionDeleteFiles(string $code): Response
    {
        $model = $this->loadModel($code);
        $fileWorker = new FileWorker(compact('model'));
        if (!$fileWorker->deleteFiles()) {
            Yii::$app->session->setFlash('error', 'Файлы не были удалены');
        }
        return $this->redirect('/admin/country/view?code=' . $model->code);
    }

    /**
     * Просмотр страны
     * @param string $code
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView(string $code): string
    {
        $model = $this->loadModel($code);
        return $this->render('detail', compact('model'));
    }

    /**
     * Загрузка модели
     * @param string $code
     * @return Country
     * @throws NotFoundHttpException
     */
    protected function loadModel(string $code): Country
    {
        if (!$model = Country::findOne($code)) {
            throw new NotFoundHttpException('Страна не найдена!');
        }
        return $model;
    }
}
