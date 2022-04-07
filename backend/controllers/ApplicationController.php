<?php

namespace app\controllers;

use app\models\Application;
use Codeception\Util\HttpCode;
use yii\db\Query;
use yii\filters\Cors;
use yii\rest\ActiveController;
use Yii;
use app\models\Ticket;

class ApplicationController extends ActiveController
{
    public $modelClass = 'app\models\Application';

    public function behaviors(): array
    {
        $behaviors = parent::behaviors();

        $behaviors['corsFilter'] = [
            'class' => Cors::class
        ];

        return $behaviors;
    }

    public function actionCreateApplication(){
        if($request = Yii::$app->request->post()){
            if(!$ticket = Ticket::findOne($request['ticket_id'])){
                return ['message'=>'Ошибка создания заявки!', "status"=>HttpCode::NOT_MODIFIED];
            }
            $numOfTickets = $ticket->event->ticket_num;

            $bookedTicketsNum = Yii::$app->db->createCommand('SELECT SUM(num) FROM application INNER JOIN ticket_application ON application.id = ticket_application.application_id INNER JOIN ticket ON ticket.id = ticket_application.ticket_id WHERE ticket.event_id = :event_id')->bindValue('event_id',$ticket->event_id)->queryScalar();
            if($bookedTicketsNum + $request['num'] <= $numOfTickets){
                $model = new Application();
                $model->user_id = $request['user_id'];
                $model->num = $request['num'];
                $model->status_id = 1;
                if(!$model->save()){
//                return $model->errors;
                    return ['message'=>'Ошибка создания билета!', "status"=>HttpCode::NOT_MODIFIED];
                }
                $ticket->link('applications',$model);
                return ['message'=>'Заявка была успешно создана!', "status"=>HttpCode::OK];
            }
            return ['message'=>'Слишком много билетов', "status"=>HttpCode::NOT_MODIFIED];
        }
    }

    public function actionGetApplicationsByUser(int $userId)
    {
        if(!$models = Application::findAll(['user_id' => $userId])){
            return [];
        }
        return $models;
    }
}