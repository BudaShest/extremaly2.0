<?php

namespace app\controllers;

use yii\filters\Cors;
use yii\rest\ActiveController;
use app\models\EventReview;

class EventReviewController extends ActiveController
{
    /** @inheritdoc  */
    public $modelClass = 'app\models\EventReview';

    /** @inheritdoc */
    protected function verbs(): array
    {
        return [
            'index' => ['GET', 'HEAD'],
            'view' => ['GET', 'HEAD'],
            'create' => ['OPTIONS','POST'],
            'update' => ['PUT', 'PATCH'],
            'delete' => ['DELETE'],
        ];
    }

    /** @inheritdoc */
    public function behaviors(): array
    {
        $behaviors = parent::behaviors();

        $behaviors['corsFilter'] = [
            'class' => Cors::class
        ];

        return $behaviors;
    }

    /**
     * Получить комментарии к событию
     * @param int $eventId
     * @return array
     */
    public function actionGetEventReviews(int $eventId): array
    {
        if(!$models = EventReview::findAll(['event_id' => $eventId])){
            return [];
        }
        return $models;
    }
}
