<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;

class EventImage extends ActiveRecord
{
    public const MODEL_FK = 'event_id';

    public function rules(): array
    {
        return [
            [['event_id', 'image'], 'required'],
            [['event_id'], 'integer'],
            [['image'], 'string'],
        ];
    }

    public function getEvent(): ActiveQuery
    {
        return $this->hasOne(Event::class, ['id' => 'event_id']);
    }
}