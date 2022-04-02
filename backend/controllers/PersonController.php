<?php

namespace app\controllers;

use yii\rest\ActiveController;
use yii\filters\Cors;

class PersonController extends ActiveController
{
    public $modelClass = 'app\models\Person';

    public function behaviors(): array
    {
        $behaviors = parent::behaviors();

        $behaviors['corsFilter'] = [ //TODO создать общий класс для контроллеров и вынести его туда
            'class' => Cors::class
        ];

        return $behaviors;
    }
}