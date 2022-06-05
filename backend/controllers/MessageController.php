<?php

namespace app\controllers;

use yii\rest\ActiveController;
use yii\filters\Cors;

class MessageController extends ActiveController
{
    /** @inheritdoc */
    public $modelClass = 'app\models\Message';

    /** @inheritdoc */
    public function behaviors(): array
    {
        $behaviors = parent::behaviors();

        $behaviors['corsFilter'] = [
            'class' => Cors::class,
        ];

        return $behaviors;
    }
}