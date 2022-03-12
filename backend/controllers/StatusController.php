<?php

namespace app\controllers;

use yii\rest\ActiveController;

class StatusController extends ActiveController //TODO не факт, что эта модель вообще нужна, чекнем попозже
{
    public $modelClass = 'app\models\Status';

}