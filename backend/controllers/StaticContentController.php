<?php

namespace app\controllers;

use yii\filters\Cors;
use yii\rest\ActiveController;

class StaticContentController extends ActiveController
{
    public $modelClass = 'app\models\StaticContent';

    public function behaviors(): array
    {
        $behaviors = parent::behaviors();

        $behaviors['corsFilter'] = [
            'class' => Cors::class
        ];

        return $behaviors;
    }

}
