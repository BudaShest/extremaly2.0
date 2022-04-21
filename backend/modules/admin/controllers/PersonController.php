<?php

namespace app\modules\admin\controllers;

use app\modules\admin\components\ErrorHelper;
use app\modules\admin\components\FileWorker;
use app\modules\admin\models\PersonLink;
use phpDocumentor\Reflection\Types\Mixed_;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\modules\admin\models\Person;
use yii\web\NotFoundHttpException;
use Yii;
use yii\web\Response;

class PersonController extends Controller
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
                'denyCallback' => function(){
                    return $this->redirect('/admin/main/login');
                },
            ]
        ];
    }

    /**
     * Загрузка модели
     * @param int $id
     * @return Person
     * @throws NotFoundHttpException
     */
    protected function loadModel(int $id): Person
    {
        if(!$model = Person::findOne($id)){
            throw new NotFoundHttpException('Модель персоны не найдена!');
        }
        return $model;
    }

    /**
     * Страница "Все персоны"
     * @return string
     */
    public function actionIndex(): string
    {
        $model = new Person();
        $personsProvider = new ActiveDataProvider([
            'query' => Person::find(),
            'pagination' => [
                'pageSize' => 10
            ]
        ]);
        return $this->render('index', compact('personsProvider'));
    }

    /**
     * Страница просмотра детальной информации о персоне(личности)
     * @param int $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView(int $id): string
    {
        $model = $this->loadModel($id);
        $personLinksProvider = new ActiveDataProvider([
            'query' => PersonLink::find()->where(['person_id' => $model->id]),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('detail', compact('model','personLinksProvider'));
    }

    /**
     * Страница обновления личности
     * @param int $id
     * @return string|Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate(int $id)
    {
        $model = $this->loadModel($id);
        $fileWorker = new FileWorker(compact('model'));
        if($model->load(Yii::$app->request->post())){
            if(!$model->save()){
                Yii::$app->session->setFlash('error', ErrorHelper::format($model->errors));
                return $this->redirect(Yii::$app->request->referrer);
            }else{
                Yii::$app->session->setFlash('success','Модель была успешно обновлена!');
            }
            if ($fileWorker->attachFiles()) {
                $fileWorker->deleteFiles();
                if(!$fileWorker->upload()){
                    Yii::$app->session->setFlash('error', 'Ошибка загрузки файла');
                }
            }
            return $this->redirect('/admin/person/view?id='.$model->id);
        }
        return $this->render('create', compact('model'));

    }

    /**
     * Страница добавления личности
     * @return string|Response
     */
    public function actionCreate()
    {
        $model = new Person();
        $fileWorker = new FileWorker(compact('model'));
        if($model->load(Yii::$app->request->post())){
            if(!$model->save()){
                Yii::$app->session->setFlash('error', ErrorHelper::format($model->errors));
                return $this->redirect(Yii::$app->request->referrer);
            }else{
                Yii::$app->session->setFlash('success','Модель была успешно добавлена!');
            }
            if ($fileWorker->attachFiles()) {
                if(!$fileWorker->upload()){
                    Yii::$app->session->setFlash('error', 'Ошибка загрузки файла');
                }
            }
            return $this->redirect('/admin/person/view?id='.$model->id);
        }
        return $this->render('create', compact('model'));
    }

    /**
     * @param string $id
     * @return Response
     * @throws NotFoundHttpException
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete(string $id): Response
    {
        $model = $this->loadModel($id);
        $fileWorker = new FileWorker(['model' => $model]);
        $fileWorker->deleteFiles();
        if(!$model->delete()){
            Yii::$app->session->setFlash('error', 'Модель не была удалена!');
        }else{
            Yii::$app->session->setFlash('success', 'Модель была успешно удалена!');
        }
        return $this->redirect('/admin/person');
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
        return $this->redirect('/admin/person/view?id=' . $model->id);
    }
}
