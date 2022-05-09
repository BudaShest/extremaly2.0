<?php

namespace app\controllers;

use yii\rest\ActiveController;
use yii\filters\Cors;

class SocialLinkController extends ActiveController
{
    /** @inheritdoc  */
    public $modelClass = 'app\models\SocialLink';

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
