<?php

namespace app\modules\admin\controllers;

use app\modules\admin\components\FileWorker;
use app\modules\admin\models\Place;
use app\modules\admin\models\Climat;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\modules\admin\models\Country;
use Yii;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;

class PlaceController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'update', 'create', 'delete', 'view'],
                        'roles' => ['@'],
                    ],
                ],
                'denyCallback' => function () {
                    return $this->redirect('main/login');
                },
            ]
        ];
    }


    public function actionIndex()
    {
        $model = new Place();
        return $this->render('index', compact('model'));
    }

    public function actionView(int $id)
    {
        if (!$model = Place::findOne($id)) {
            throw new NotFoundHttpException('Место с таким идентификатором отсутствует');
        }
        return $this->render('detail', compact('model'));
    }

    public function actionCreate()
    {
        $place = new Place();
        $placeFileWorker = new FileWorker(['model' => $place]);
        $country = new Country();
        $countryFileWorker = new FileWorker(['model' => $country]);
        $climat = new Climat();
        $climatFileWorker = new FileWorker(['model' => $climat]);
        if ($place->load(Yii::$app->request->post())) {
            if (!$place->save()) {
                var_dump($place->errors);die;
            } else {
                Yii::$app->session->setFlash('success', 'Модель была успешно добавлена!');
            }
            if ($placeFileWorker->attachFiles()) {
                if(!$placeFileWorker->upload()){
                    Yii::$app->session->setFlash('error', 'Ошибка загрузки файла');
                }
            }
            return $this->redirect('/admin/place/view?id'.$place->id);
        }
        if ($country->load(Yii::$app->request->post())) {
            if ($countryFileWorker->attachFile()) {
                if (!$countryFileWorker->upload()) {
                    Yii::$app->session->setFlash('error', 'Ошибка загрузки файла');
                }
            }
            if (!$country->save()) {
                var_dump($country->errors);die;
            } else {
                Yii::$app->session->setFlash('success', 'Модель была успешно добавлена!');
            }
            return $this->redirect('/admin/place/view?id'.$place->id);
        }
        if ($climat->load(Yii::$app->request->post())) {
            if ($climatFileWorker->attachFile()) {
                if(!$climatFileWorker->upload()){
                    Yii::$app->session->setFlash('error', 'Ошибка загрузки файла');
                }
            }
            if (!$climat->save()) {
                var_dump($climat->errors);die;
            } else {
                Yii::$app->session->setFlash('success', 'Модель была успешно добавлена!');
            }
            return $this->redirect('/admin/place/view?id'.$place->id);
        }
        return $this->render('create', compact('country', 'climat', 'place'));
    }


    public function actionUpdate(int $id)
    {
        if (!$model = Place::findOne($id)) {
            throw new NotFoundHttpException('Место с таким идентификатором отсутствует');
        }
        $fileWorker = new FileWorker(['model' => $model]);
        if ($model->load(Yii::$app->request->post())) {
            $fileWorker->deleteFiles();
            if ($fileWorker->attachFiles()) {
                $fileWorker->deleteFiles();
                if(!$fileWorker->upload()){
                    Yii::$app->session->setFlash('error', 'Ошибка загрузки файла');
                }
            }
            return $this->redirect('/admin/place/view?id'.$model->id);
        }
        return $this->render('create', ['place' => $model]);
    }


    public function actionDelete(int $id)
    {
        if (!$model = Place::findOne($id)) {
            throw new NotFoundHttpException('Место с таким идентификатором отсутствует');
        }
        $fileWorker = new FileWorker(['model' => $model]);
        $fileWorker->deleteFiles();
        if(!$model->delete()){
            Yii::$app->session->setFlash('error', 'Модель не была удалена!');
        }else{
            Yii::$app->session->setFlash('success', 'Модель была успешно удалена!');
        }
        return $this->redirect('/admin/place');
    }
}