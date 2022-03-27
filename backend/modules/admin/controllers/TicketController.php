<?php

namespace app\modules\admin\controllers;

use yii\data\ArrayDataProvider;
use yii\data\SqlDataProvider;
use yii\web\Controller;
use app\modules\admin\models\Event;
use app\modules\admin\models\Ticket;
use app\modules\admin\models\TicketGenerator;

use Yii;

class TicketController extends Controller
{
    public function actionIndex()
    {
        $dataProvider = new SqlDataProvider([
            'sql' => 'SELECT event_id, SUM(price) as total, privilege FROM ticket GROUP BY event_id, privilege'
        ]);



        return $this->render('index', compact('dataProvider'));

    }

    public function actionCreate()
    {
        $model = new TicketGenerator();
        $event = new Event();
        if($model->load(Yii::$app->request->post())){
            $model->make();
        }
        return $this->render('create',compact('model', 'event'));
    }


}