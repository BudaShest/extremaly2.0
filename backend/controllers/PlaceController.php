<?php

namespace app\controllers;

use yii\filters\Cors;
use yii\rest\ActiveController;
use app\models\Place;
use yii\web\NotFoundHttpException;

class PlaceController extends ActiveController
{
    public $modelClass = "app\models\Place";

    public function behaviors(): array
    {
        $behaviors = parent::behaviors();

        $behaviors['corsFilter'] = [
            'class' => Cors::class
        ];

        return $behaviors;
    }

    public function actionGetByCountryCode(string $countryCode)
    {
        if(!$models = Place::find()->where(['country_code' => $countryCode])->all()){
            return [];
        }
        return $models;
    }

    public function actionGetByClimatCode(string $climatCode)
    {
        if(!$models = Place::find()->where(['climat_code' => $climatCode])->all()){
            return [];
        }
        return $models;
    }
}
