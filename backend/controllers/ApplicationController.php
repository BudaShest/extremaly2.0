<?php

namespace app\controllers;

use app\models\Status;
use app\models\Ticket;
use app\models\Application;
use app\models\TicketApplication;
use app\modules\admin\components\ErrorHelper;
use Codeception\Util\HttpCode;
use Yii;
use yii\filters\auth\HttpBearerAuth;
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

//        $behaviors['authenticator'] = [
//            'class' => HttpBearerAuth::class,
//        ];

        return $behaviors;
    }

    /** @inheritdoc */
    protected function verbs(): array
    {
        return [
            'index' => ['OPTIONS', 'GET', 'HEAD'],
            'view' => ['OPTIONS', 'GET', 'HEAD'],
            'create' => ['OPTIONS', 'POST'],
            'update' => ['OPTIONS', 'PUT', 'PATCH'],
            'delete' => ['OPTIONS', 'DELETE'],
            'create-application' => ['OPTIONS', 'POST'],
            'get-applications-by-user' => ['OPTIONS', 'GET', 'HEAD']
        ];
    }


    /**
     * Созадание заявки
     * @return array|\yii\web\Response
     */
    public function actionCreateApplication()
    {
        $request = Yii::$app->request->post();
        $model = new Application();
        $model->user_id = $request['user_id'];
        $model->num = array_sum(array_column($request['tickets'], 'cnt'));
        $model->status_id = Status::DEFAULT_STATUS_ID;
        if (!$model->save()) {
            return ['message' => 'Ошибка создания заявки!', "status" => HttpCode::NOT_MODIFIED, 'errors' => ErrorHelper::format($model->errors)];
        }
        foreach ($request['tickets'] as $item) {
            if (!$ticket = Ticket::findOne($item['id'])) {
                return ['message' => 'Ошибка создания заявки!', "status" => HttpCode::NOT_MODIFIED];
            }
            if ($ticket->event->ticket_num >= $item['cnt']) {
                $ticketApp = new TicketApplication();
                $ticketApp->ticket_id = $ticket->id;
                $ticketApp->application_id = $model->id;
                $ticketApp->num = $item['cnt'];
                if ($ticketApp->save()) {
                    $event = $ticket->event;
                    $event->ticket_num = $event->ticket_num - $item['cnt'];
                    $event->save();
                }
            } else {
                return ['message' => 'Было выбрано слишком много билетов!', "status" => HttpCode::NOT_MODIFIED];
            }
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
