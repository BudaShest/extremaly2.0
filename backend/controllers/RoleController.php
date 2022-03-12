<?php

namespace app\controllers;

use yii\rest\ActiveController;

class RoleController extends ActiveController
{
    //TODO фильтры на роль админа (а может и тоже удалю модель)
    public $modelClass = 'app\models\Role';
}