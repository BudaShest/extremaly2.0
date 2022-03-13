<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\Climat;
use yii\web\Controller;
use app\modules\admin\models\Country;
use Yii;

class PlaceController extends Controller
{


    public function actionIndex()
    {
        $country = Yii::createObject(['class'=>Country::class]);
        $climat = Yii::createObject(['class'=>Climat::class]);
        return $this->render('index', compact('country','climat'));
    }
}