<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;

class Event extends ActiveRecord
{
    public function rules(): array
    {
        return [
          [['name', 'place_id', 'type_id'], 'required'],
            [['name', 'offer', 'description'], 'string'],
            [['from', 'until'], 'date'],
            [['age_restrictions','priority','place_id','type_id'],'integer'],
            [['is_horizontal'],'boolean'],
            [['name'], 'unique'],
        ];
    }

    public function getPlace(): ActiveQuery
    {
        return $this->hasOne(Place::class, ['id' => 'place_id']);
    }

    public function getType(): ActiveQuery
    {
        return $this->hasOne(EventType::class, ['id' => 'type_id']);
    }

    public function getImages(): ActiveQuery
    {
        return $this->hasMany(EventImage::class, ['event_id' => 'id']);
    }

    public function getTickets(): ActiveQuery
    {
        return $this->hasMany(Ticket::class, ['event_id' => 'id']);
    }
}