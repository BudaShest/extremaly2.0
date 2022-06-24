<?php

namespace app\controllers;

use yii\data\Pagination;
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
        $query = EventReview::find()->where(['event_id' => $eventId]);

        $pagination = new Pagination([
            'totalCount' => $query->count(),
        ]);
        $models = $query->limit($pagination->limit)->offset($pagination->offset)->all();
        return $models;
    }

    /**
     * Получить количество страниц
     * @return int
     */
    public function actionGetNumOfPages(int $eventId): int
    {
        $query = EventReview::find()->where(['event_id' => $eventId]);

        $pagination = new Pagination(['totalCount' => $query->count(), 'pageSize' => 3]);
        return $pagination->pageCount;
    }
}
