<?php

namespace app\controllers;
use yii\filters\Cors;
use yii\rest\ActiveController;

class AdvantageController extends ActiveController
{
    public $modelClass = 'app\models\Advantage';

    public function behaviors(): array
    {
        $behaviors = parent::behaviors();

        $behaviors['corsFilter'] = [
            'class' => Cors::class
        ];

        return $behaviors;
    }
}
