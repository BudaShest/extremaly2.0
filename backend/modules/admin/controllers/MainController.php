<?php

namespace app\modules\admin\controllers;

use SebastianBergmann\CodeCoverage\TestFixture\C;
use yii\web\Controller;

class MainController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
}