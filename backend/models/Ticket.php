<?php

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;

class Ticket extends ActiveRecord
{
    public function rules(): array
    {
        return [
          [['event_id','price','privilege'], 'required'],
          [['event_id', 'price'], 'integer'],
          [['privilege'], 'string'],
        ];
    }

    public function getEvent(): ActiveQuery
    {
        return $this->hasOne(Event::class, ['id' => 'event_id']);
    }
}