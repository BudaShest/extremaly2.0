<?php

namespace app\controllers;

use yii\filters\Cors;
use yii\rest\ActiveController;

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
}