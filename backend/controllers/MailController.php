<?php

namespace app\controllers;
use Codeception\Util\HttpCode;
use yii\filters\Cors;
use yii\filters\VerbFilter;
use yii\rest\ActiveController;
use Yii;

class MailController extends ActiveController
{
    /** @inheritdoc  */
    public $modelClass = 'app\models\Mail';

    /** @inheritdoc  */
    public function behaviors(): array
    {
        $behaviors = parent::behaviors();

        $behaviors['corsFilter'] = [
            'class' => Cors::class
        ];

        $behaviors['verbs'] = [
            'class' => VerbFilter::class,
            'actions' => [
                'send-mail' => ['post']
            ],
        ];

        return $behaviors;
    }

    /**
     * Отправка письма
     * @return array
     */
    public function actionSendMail():array
    {
        try {
            $request = Yii::$app->request->post();
            if (Yii::$app->mailer->compose()
                ->setFrom('rsx99@mail.ru')
                ->setTo('rsx99@mail.ru')
                ->setSubject($request['subject'] ?? "Без темы")
                ->setTextBody($request['text'] ?? "Без текста")
                ->send()) {
                Yii::$app->response->statusCode = HttpCode::CREATED;
                return ['message' => 'Письмо было успешно доставлено', 'status' => HttpCode::CREATED];
            }
            return ['message' => 'Ошибка отправки письма', 'status' => HttpCode::INTERNAL_SERVER_ERROR];
        } catch (\Exception $e) {
            Yii::$app->response->statusCode = HttpCode::INTERNAL_SERVER_ERROR;
            return ['message' => $e->getMessage(), 'status' => HttpCode::INTERNAL_SERVER_ERROR];
        }
    }
}
