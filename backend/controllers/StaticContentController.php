<?php

namespace app\controllers;

use yii\filters\Cors;
use yii\rest\ActiveController;

class StaticContentController extends ActiveController
{
    /** @inheritdoc  */
    public $modelClass = 'app\models\StaticContent';

    /** @inheritdoc  */
    public function behaviors(): array
    {
        $behaviors = parent::behaviors();

        $behaviors['corsFilter'] = [
            'class' => Cors::class
        ];

        return $behaviors;
    }

}
