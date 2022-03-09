<?php

use yii\db\ActiveRecord;

class Ticket extends ActiveRecord
{
    public function rules()
    {
        return [
          [['event_id','price','privilege'], 'required'],
          [['event_id', 'price'], 'integer'],
          [['privilege'], 'string'],
        ];
    }

    public function getEvent()
    {
        return $this->hasOne(Event::class, ['id' => 'event_id']);
    }
}