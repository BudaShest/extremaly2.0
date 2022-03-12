<?php

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;

class EventType extends ActiveRecord
{
    public $uploads;

    public function rules(): array
    {
        return [
          [['name','icon'],'required'],
            [['name','icon'],'string'],
            [['name'],'unique'],
            [['uploads'], 'file', 'extensions'=>['png', 'jpg', 'gif'], 'maxSize' => 1024*1024] //todo возможно создать встроенный валидатор или как то вынести код
        ];
    }

    public function getEvents(): ActiveQuery
    {
        return $this->hasMany(Event::class, ['type_id'=>'id']);
    }
}