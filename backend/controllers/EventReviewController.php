<?php

namespace app\controllers;

use yii\filters\Cors;
use yii\rest\ActiveController;
use app\models\EventReview;

class EventReviewController extends ActiveController
{
    public $modelClass = 'app\models\EventReview';

//    public function actions()
//    {
//        return [
//            'options' => [
//                'class' => 'yii\rest\OptionsAction',
//            ],
//        ];
//    }

    protected function verbs()
    {
        return [
            'index' => ['GET', 'HEAD'],
            'view' => ['GET', 'HEAD'],
            'create' => ['OPTIONS','POST'],
            'update' => ['PUT', 'PATCH'],
            'delete' => ['DELETE'],
        ];
    }

    public function behaviors(): array
    {
        $behaviors = parent::behaviors();

        $behaviors['corsFilter'] = [
            'class' => Cors::class
        ];

        return $behaviors;
    }

    public function actionGetEventReviews(int $eventId)
    {
        if(!$models = EventReview::findAll(['event_id' => $eventId])){
            return [];
        }
        return $models;
    }
}