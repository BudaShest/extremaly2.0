<?php

namespace app\controllers;

use yii\rest\ActiveController;
use yii\filters\Cors;

class PersonLinkController extends ActiveController
{
    public $modelClass = 'app\models\PersonLink';

    public function behaviors(): array
    {
        $behaviors = parent::behaviors();

        $behaviors['corsFilter'] = [
            'class' => Cors::class
        ];

        return $behaviors;
    }
}
