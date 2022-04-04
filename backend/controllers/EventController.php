<?php

namespace app\controllers;


use yii\filters\Cors;
use yii\rest\ActiveController;
use app\models\Event;

class EventController extends ActiveController
{
    public $modelClass = 'app\models\Event';

    public function behaviors(): array
    {
        $behaviors = parent::behaviors();

        $behaviors['corsFilter'] = [
            'class' => Cors::class
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

    public function actionGetEventsForOlds()
    {
        if(!$models = Event::find()->where(['>=','age_restrictions', '18'])->all()){
            return [];
        }
        return $models;
    }

    public function actionGetEventsByPrority()
    {

    }


}