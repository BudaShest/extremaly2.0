<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Модель "Вложения сообщения"
 * Attributes:
 * @property int $id - ID
 * @property int $message_id -
 * @property string $path -
 * Relations:
 * @property Message $message
 */
class MessageAttachment extends ActiveRecord
{
    /** @inheritdoc */
    public function rules(): array
    {
        return [
            [['message_id', 'path'], 'required'],
            [['message_id'], 'integer'],
            [['path'], 'string']
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getMessage(): ActiveQuery
    {
        return $this->hasOne(Message::class, ['id' => 'message_id']);
    }
}
