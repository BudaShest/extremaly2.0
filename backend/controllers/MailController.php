<?php

namespace app\controllers;
use Codeception\Util\HttpCode;
use yii\filters\Cors;
use yii\rest\ActiveController;
use Yii;

class MailController extends ActiveController
{
    public $modelClass = 'app\models\Mail';

    public function behaviors(): array
    {
        $behaviors = parent::behaviors();

        $behaviors['corsFilter'] = [
            'class' => Cors::class
        ];

        return $behaviors;
    }

//    protected function verbs()
//    {
//        return [
//            'index' => ['GET', 'HEAD'],
//            'view' => ['GET', 'HEAD'],
//            'send-mail' => ['OPTIONS','POST'],
//            'update' => ['PUT', 'PATCH'],
//            'delete' => ['DELETE'],
//        ];
//    }

    public function actionSendMail()
    {
        try{
            if($request = Yii::$app->request->post()){
                if(Yii::$app->mailer->compose()
                    ->setFrom($request['mail'])
                    ->setTo('rsx99@mail.ru')
                    ->setSubject($request['subject'])
                    ->setTextBody($request['text'])
                    ->send()){
                    return ['message' => 'Письмо было успешно доставлено', 'status' => HttpCode::OK];
                }
                return ['message' => 'Ошибка отправки письма', 'status' => HttpCode::INTERNAL_SERVER_ERROR];
            }
            throw new \HttpRequestMethodException('Только POST');
        }catch (\Exception $e){
            return ['message' => $e->getMessage(), 'status' => HttpCode::INTERNAL_SERVER_ERROR];
        }

    }
}