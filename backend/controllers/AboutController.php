<?php

namespace app\controllers;

use yii\filters\Cors;
use yii\rest\ActiveController;

class AboutController extends ActiveController
{
    /** @inheritdoc */
    public $modelClass = 'app\models\About';

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
