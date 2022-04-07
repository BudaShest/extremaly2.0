<?php

namespace app\modules\admin\controllers;

use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\data\SqlDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\modules\admin\models\Event;
use app\modules\admin\models\Ticket;
use app\modules\admin\models\TicketGenerator;

use Yii;

class TicketController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'create', 'delete', 'view'],
                        'roles' => ['@'],
                    ],
                ],
                'denyCallback' => function(){
                    return $this->redirect('main/login');
                },
            ]
        ];
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Ticket::find(),
            'pagination' => [
                'pageSize' => 10
            ]
        ]);

        return $this->render('index', compact('dataProvider'));
    }

    public function actionCreate()
    {
        $model = new Ticket();
        if($model->load(Yii::$app->request->post())){
            if(!$model->save()){
                var_dump($model->errors);
            }
            return $this->redirect('/admin/ticket');
        }
        return $this->render('create',compact('model'));
    }


}