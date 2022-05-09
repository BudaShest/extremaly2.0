<?php

namespace app\controllers;

use yii\filters\Cors;
use yii\rest\ActiveController;

class CountryController extends ActiveController
{
    /** @inheritdoc */
    public $modelClass = 'app\models\Country';

    /** @inheritdoc */
    public function behaviors(): array
    {
        $behaviors = parent::behaviors();

        $behaviors['corsFilter'] = [
            'class' => Cors::class
        ];

        return $behaviors;
    }
}
