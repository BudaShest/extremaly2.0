<?php

namespace app\controllers;


use yii\filters\Cors;
use yii\rest\ActiveController;
use app\models\Event;
use app\models\Place;

class EventController extends ActiveController
{
    public $modelClass = 'app\models\Event';


    public function behaviors(): array
    {
        $behaviors = parent::behaviors();

        $behaviors['corsFilter'] = [
            'class' => Cors::class,
        ];

        return $behaviors;
    }

    public function actionGetEventsByAge(int $age)
    {
        if(!$models = Event::find()->where(['<','age_restrictions', $age])->all()){
            return [];
        }
        return $models;
    }

    public function actionGetEventsForKids()
    {
        if(!$models = Event::find()->where(['<','age_restrictions', '18'])->all()){
            return [];
        }
        return $models;
    }

    public function actionGetEventsByPriority()
    {
        if(!$models = Event::find()->limit(3)->orderBy('priority')->all()){
            return [];
        }
        return $models;
    }

    public function actionGetEventsForOlds()
    {
        if(!$models = Event::find()->where(['>=','age_restrictions', '18'])->all()){
            return [];
        }
        return $models;
    }

    public function actionGetEventsByClimat($code)
    {
        if(!$models = Place::findAll(['climat_code' => $code])){
            return [];
        }
        $result = [];
        foreach ($models as $model){
            $result += $model->events;
        }
        return $result;
    }


    public function actionGetEventsByCountry(string $code)
    {
        if(!$models = Place::findAll(['country_code' => $code])){
            return [];
        }
        $result = [];
        foreach ($models as $model){
            $result += $model->events;
        }
        return $result;
    }

    public function actionGetEventsByFounded(string $requestedString)
    {
        if($models = Event::find()->where(['like', 'name', $requestedString])->all()){
           return $models;
        }
        if($models = Event::find()->where(['like', 'offer', $requestedString])->all()){
            return $models;
        }
        if($models = Place::find()->where(['like', 'name', $requestedString])->all()){
            $result = [];
            foreach ($models as $model){
                $result += $model->events;
            }
            return $result;
        }
        return [];
    }


}