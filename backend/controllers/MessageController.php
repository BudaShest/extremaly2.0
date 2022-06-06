<?php

namespace app\controllers;

use app\models\Message;
use yii\rest\ActiveController;
use yii\filters\Cors;

class MessageController extends ActiveController
{
    /** @inheritdoc */
    public $modelClass = 'app\models\Message';

    /** @inheritdoc */
    public function behaviors(): array
    {
        $behaviors = parent::behaviors();

        $behaviors['corsFilter'] = [
            'class' => Cors::class,
        ];

        return $behaviors;
    }

    /**
     * Получить сообщения пользователяы
     * @param int $userId
     * @return array
     */
    public function actionGetUserMessages(int $userId): array
    {
        return Message::find()->where(['from_id' => $userId])->all();
    }
}