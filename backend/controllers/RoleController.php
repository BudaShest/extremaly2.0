<?php

namespace app\controllers;

use yii\rest\ActiveController;

class RoleController extends ActiveController
{
    /** @inheritdoc  */
    public $modelClass = 'app\models\Role';
}
