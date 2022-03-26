<?php

namespace app\modules\admin\controllers;

use app\modules\admin\components\FileWorker;
use app\modules\admin\models\Place;
use app\modules\admin\models\Climat;
use yii\web\Controller;
use app\modules\admin\models\Country;
use Yii;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;

class PlaceController extends Controller
{
    //TODO flash о результатах операции

    public function actionIndex()
    {
        $model = new Place();
        return $this->render('index', compact('model'));
    }

    public function actionView(int $id)
    {
        if(!$model = Place::findOne($id)){
            throw new NotFoundHttpException( 'Место с таким идентификатором отсутствует');
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
        if($place->load(Yii::$app->request->post())){
//            var_dump($place);die;
            if(!$place->save()){
//                var_dump($place->errors);die;
            }
            if(!$placeFileWorker->attachFiles() || !$placeFileWorker->upload()){
                Yii::$app->session->setFlash('error', 'Ошибка загрузки файлов');
            }
            return $this->redirect('/admin/place/create');
        }
        if($country->load(Yii::$app->request->post())){
            if(!$countryFileWorker->attachFile() || !$countryFileWorker->upload()){
                Yii::$app->session->setFlash('error', 'Ошибка загрузки файла');
            }
            if(!$country->save()){
                var_dump($country->errors);die;
            }
            return $this->redirect('/admin/place/create');
        }
        if($climat->load(Yii::$app->request->post())){
            if(!$climatFileWorker->attachFile() || !$climatFileWorker->upload()){
                Yii::$app->session->setFlash('error', 'Ошибка загрузки файла');
            }
            if(!$climat->save()){
                var_dump($climat->errors);die;
            }
            return $this->redirect('/admin/place/create');
        }
        return $this->render('create', compact('country','climat', 'place'));
    }


    public function actionUpdate(int $id)
    {
        if($model = Place::findOne($id)){
            throw new NotFoundHttpException('Место с таким идентификатором отсутствует');
        }
        if($model->load(Yii::$app->request->post())){
            if(!$model->save){

            }
            return $this->render('');
        }
    }


    public function actionDelete(int $id)
    {
        if(!$model = Place::findOne($id)){
            throw new NotFoundHttpException('Место с таким идентификатором отсутствует');
        }
        $model->delete();
        return $this->redirect(Yii::$app->request->referrer);
    }
}