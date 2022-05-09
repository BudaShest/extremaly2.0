<?php

namespace app\controllers;

use yii\filters\Cors;
use yii\rest\ActiveController;
use app\models\Event;
use app\models\Place;

class EventController extends ActiveController
{
    /** @inheritdoc */
    public $modelClass = 'app\models\Event';

    /** @inheritdoc */
    public function behaviors(): array
    {
        $behaviors = parent::behaviors();

        $behaviors['corsFilter'] = [
            'class' => Cors::class,
        ];

        return $behaviors;
    }

    /**
     * Получить события по возрастному ограничению
     * @param int $age
     * @return array|\yii\db\ActiveRecord[]
     */
    public function actionGetEventsByAge(int $age): array
    {
        if(!$models = Event::find()->where(['<','age_restrictions', $age])->all()){
            return [];
        }
        return $models;
    }

    /**
     * Получить события, подходящие для детей
     * @return array
     */
    public function actionGetEventsForKids(): array
    {
        if(!$models = Event::find()->where(['<','age_restrictions', '18'])->all()){
            return [];
        }
        return $models;
    }

    /**
     * Получить события по приоритету
     * @return array
     */
    public function actionGetEventsByPriority(): array
    {
        if(!$models = Event::find()->limit(3)->orderBy('priority')->all()){
            return [];
        }
        return $models;
    }

    /**
     * Получить события только для взрослых
     * @return array
     */
    public function actionGetEventsForOlds(): array //todo нейминг
    {
        if(!$models = Event::find()->where(['>=','age_restrictions', '18'])->all()){
            return [];
        }
        return $models;
    }

    /**
     * Получить события по типу климата
     * @param string $code
     * @return array
     */
    public function actionGetEventsByClimat(string $code): array
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

    /**
     * Получить события по стране провердения
     * @param string $code
     * @return array
     */
    public function actionGetEventsByCountry(string $code): array
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

    /**
     * @param string $requestedString
     * @return array
     */
    public function actionGetEventsByFounded(string $requestedString): array
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

    /**
     * @param int $placeId
     * @return array
     */
    public function actionGetEventsByPlace(int $placeId): array
    {
        if(!$models = Event::findAll(['place_id' => $placeId])){
            return [];
        }
        return $models;
    }
}
