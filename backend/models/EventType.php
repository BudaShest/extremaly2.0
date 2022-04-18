<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;

class EventType extends ActiveRecord
{

    public function rules(): array
    {
        return [
            [['name', 'icon'], 'required'],
            [['name', 'icon'], 'string'],
            [['name'], 'unique'],
        ];
    }

    public function getEvents(): ActiveQuery
    {
        return $this->hasMany(Event::class, ['type_id' => 'id']);
    }
}
