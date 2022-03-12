<?php

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;

class EventImage extends ActiveRecord
{
    public $uploads;

    public function rules(): array
    {
        return [
            [['event_id','image','uploads'],'required'],
            [['event_id'],'integer'],
            [['image'],'string'],
            [['uploads'], 'file', 'extensions'=>['png', 'jpg', 'gif'], 'maxSize' => 1024*1024] //todo возможно создать встроенный валидатор или как то вынести код
        ];
    }

    public function getEvent(): ActiveQuery
    {
        return $this->hasOne(Event::class, ['id' => 'event_id']);
    }
}