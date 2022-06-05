<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;

/**
 * Модель "Сообщение"
 * Attributes:
 * @property int $id -
 * @property int $from_id -
 * @property int $to_id -
 * @property string $text -
 * @property bool $was_read -
 * Relations:
 * @property MessageAttachment $attachments
 */
class Message extends ActiveRecord
{
    /** @inheritdoc */
    public function rules(): array
    {
        return [
            [['from_id', 'to_id', 'text',], 'required'],
            [['from_id', 'to_id'], 'integer'],
            [['was_read'], 'boolean'],
            [['text'], 'string'],
            [['text'], 'trim']
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getAttachments(): ActiveQuery
    {
        return $this->hasMany(MessageAttachment::class, ['message_id' => 'id']);
    }
}