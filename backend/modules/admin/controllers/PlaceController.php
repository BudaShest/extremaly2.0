<?php

namespace app\modules\admin\controllers;

use app\models\Place;
use app\modules\admin\models\Climat;
use yii\web\Controller;
use app\modules\admin\models\Country;
use Yii;
use yii\web\NotFoundHttpException;

class PlaceController extends Controller
{
    //TODO flash о результатах операции

    public function actionIndex()
    {

    }

    public function actionView(int $id)
    {
        if($model = Place::findOne($id)){
            throw new NotFoundHttpException( 'Место с таким идентификатором отсутствует');
        }
    }

    public function actionCreate()
    {
        //TODO отказаться от этого в пользу раздельного присваивания
        $place = Yii::createObject(['class'=>Place::class]);
        $country = Yii::createObject(['class'=>Country::class]);
        $climat = Yii::createObject(['class'=>Climat::class]);
        if($place->load(Yii::$app->request->post())){
            if($country->load(Yii::$app->request->post())){
                $place->link('country', $country);
            }
            if($climat->load(Yii::$app->request->post())){
                $place->link('climat', $climat);
            }

            if(!$place->save()){
                var_dump($country->errors);
                var_dump($climat->errors);
            }
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
        if($model = Place::findOne($id)){
            throw new NotFoundHttpException('Место с таким идентификатором отсутствует');
        }
        $model->delete();
        return $this->redirect('admin/place');
    }
}