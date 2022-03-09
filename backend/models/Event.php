<?php

use yii\db\ActiveRecord;

class Event extends ActiveRecord
{
    public function rules()
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

    public function getPlace()
    {
        return $this->hasOne(Place::class, ['id' => 'place_id']);
    }

    public function getType()
    {
        return $this->hasOne(EventType::class, ['id' => 'type_id']);
    }

    public function getImages()
    {
        return $this->hasMany(EventImage::class, ['event_id' => 'id']);
    }

    public function getTickets()
    {
        return $this->hasMany(Ticket::class, ['event_id' => 'id']);
    }
}