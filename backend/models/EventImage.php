<?php

use yii\db\ActiveRecord;

class EventImage extends ActiveRecord
{
    public $uploads;

    public function rules()
    {
        return [
            [['event_id','image','uploads'],'required'],
            [['event_id'],'integer'],
            [['image'],'string'],
            [['uploads'], 'file', 'extensions'=>['png', 'jpg', 'gif'], 'maxSize' => 1024*1024] //todo возможно создать встроенный валидатор или как то вынести код
        ];
    }

    public function getEvent()
    {
        return $this->hasOne(Event::class, ['id' => 'event_id']);
    }
}