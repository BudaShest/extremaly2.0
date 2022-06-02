<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;

/**
 * Модель "Тип события"
 * @property int $id - ID
 * @property string $name - Название
 * @property string $icon - Иконка
 * @property Event $events - События
 */
class EventType extends ActiveRecord
{
    /** @inheritdoc */
    public function rules(): array
    {
        return [
            [['name', 'icon'], 'required'],
            [['name', 'icon'], 'string'],
            [['name'], 'unique'],
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getEvents(): ActiveQuery
    {
        return $this->hasMany(Event::class, ['type_id' => 'id']);
    }
}
