<?php

namespace app\controllers;

use yii\rest\ActiveController;

class StatusController extends ActiveController
{
    /** @inheritdoc  */
    public $modelClass = 'app\models\Status';
}
