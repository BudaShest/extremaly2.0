<?php

namespace app\controllers;

use yii\filters\Cors;
use yii\rest\ActiveController;
use app\models\Ticket;

class TicketController extends ActiveController
{
    public $modelClass = 'app\models\Ticket';

    public function behaviors(): array
    {
        $behaviors = parent::behaviors();

        $behaviors['corsFilter'] = [
            'class' => Cors::class
        ];

        return $behaviors;
    }

    public function actionGetTicketsByEvent(int $eventId)
    {
        if(!$models = Ticket::findAll(['event_id' => $eventId])){
            return [];
        }
        return $models;
    }
}
