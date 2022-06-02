<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;

/**
 * Модель "Изображение события"
 * @property int $id - ID
 * @property int $event_id - ID события
 * @property string $image - Изображение
 */
class EventImage extends ActiveRecord
{
    /** @var string Первичный ключ связанной медели */
    public const MODEL_FK = 'event_id';

    /** @inheritdoc */
    public function rules(): array
    {
        return [
            [['event_id', 'image'], 'required'],
            [['event_id'], 'integer'],
            [['image'], 'string'],
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getEvent(): ActiveQuery
    {
        return $this->hasOne(Event::class, ['id' => 'event_id']);
    }
}
