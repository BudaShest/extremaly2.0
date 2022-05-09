<?php

namespace app\controllers;

use yii\filters\Cors;
use yii\rest\ActiveController;
use app\models\Ticket;

class TicketController extends ActiveController
{
    /** @inheritdoc */
    public $modelClass = 'app\models\Ticket';

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
     * Получить билеты по событию
     * @param int $eventId
     * @return array
     */
    public function actionGetTicketsByEvent(int $eventId): array
    {
        if (!$models = Ticket::findAll(['event_id' => $eventId])) {
            return [];
        }
        return $models;
    }
}
