<?php

namespace app\controllers;

use yii\filters\Cors;
use yii\rest\ActiveController;

class ReviewController extends ActiveController
{
    public $modelClass = 'app\models\Review';

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
}