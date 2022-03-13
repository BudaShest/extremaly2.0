<?php

namespace app\controllers;

use yii\filters\Cors;
use yii\rest\ActiveController;



class CountryController extends ActiveController
{
    public $modelClass = 'app\models\Country';

    public function behaviors(): array
    {
        $behaviors = parent::behaviors();

        $behaviors['corsFilter'] = [ //TODO создать общий класс для контроллеров и вынести его туда
            'class' => Cors::class
        ];

        return $behaviors;
    }
}