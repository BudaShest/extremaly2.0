<?php

namespace app\controllers;

use app\models\Status;
use app\models\Ticket;
use app\models\Application;
use app\modules\admin\components\ErrorHelper;
use Codeception\Util\HttpCode;
use Yii;
use yii\filters\Cors;
use yii\filters\VerbFilter;
use yii\rest\ActiveController;


class ApplicationController extends ActiveController
{
    /** @inheritdoc */
    public $modelClass = 'app\models\Application';

    /** @inheritdoc */
    public function behaviors(): array
    {
        $behaviors = parent::behaviors();

        $behaviors['corsFilter'] = [
            'class' => Cors::class
        ];

        $behaviors['verbs'] = [
            'class' => VerbFilter::class,
            'actions' => [
                'create-application' => ['post']
            ]
        ];

        return $behaviors;
    }

    /**
     * Создание заявки
     * @throws \yii\db\Exception
     */
//    public function actionCreateApplication(): array
//    {
//        $request = Yii::$app->request->post();
//        var_dump($request);die;
//        if (!$ticket = Ticket::findOne($request['ticket_id'])) {
//            return ['message' => 'Ошибка создания заявки!', "status" => HttpCode::NOT_MODIFIED];
//        }
//        $numOfTickets = $ticket->event->ticket_num;
//
//        $bookedTicketsNum = Yii::$app->db->createCommand('SELECT SUM(num) FROM application INNER JOIN ticket_application ON application.id = ticket_application.application_id INNER JOIN ticket ON ticket.id = ticket_application.ticket_id WHERE ticket.event_id = :event_id')->bindValue('event_id', $ticket->event_id)->queryScalar();
//        if ($bookedTicketsNum + $request['num'] <= $numOfTickets) {
//            $model = new Application();
//            $model->user_id = $request['user_id'];
//            $model->num = $request['num'];
//            $model->status_id = 1;
//            if (!$model->save()) {
//                return ['message' => 'Ошибка создания билета!', "status" => HttpCode::NOT_MODIFIED, 'errors' => ErrorHelper::format($model->errors)];
//            }
//            $ticket->link('applications', $model);
//            Yii::$app->response->statusCode = 201;
//            return ['message' => 'Заявка была успешно создана!', "status" => HttpCode::CREATED];
//        }
//        return ['message' => 'Слишком много билетов', "status" => HttpCode::NOT_MODIFIED];
//
//    }

    public function actionCreateApplication()
    {
        $request = Yii::$app->request->post();
//        var_dump($request);die;
        $model = new Application();
        $model->user_id = $request['user_id'];
        $model->num = array_sum(array_column($request['tickets'], 'cnt'));
        $model->status_id = Status::DEFAULT_STATUS_ID;
        if (!$model->save()){
            return ['message' => 'Ошибка создания заявки!', "status" => HttpCode::NOT_MODIFIED, 'errors' => ErrorHelper::format($model->errors)];
        }
        foreach ($request['tickets'] as $item) {
            if (!$ticket = Ticket::findOne($item['id'])) {
                return ['message' => 'Ошибка создания заявки!', "status" => HttpCode::NOT_MODIFIED];
            }
            if ($ticket->event->ticket_num >= $item['cnt']) {
                $ticket->link('applications', $model);
            } else {
                return ['message' => 'Было выбрано слишком много билетов!', "status" => HttpCode::NOT_MODIFIED];
            }
//            var_dump($model);die;
        }
        return $this->redirect('http://localhost:3000/user');
    }

    /**
     * Получение заявок по пользователю
     * @param int $userId
     * @return Application[]|array
     */
    public function actionGetApplicationsByUser(int $userId): array
    {
        if (!$models = Application::findAll(['user_id' => $userId])) {
            return [];
        }
        return $models;
    }
}
