<?php

use yii\db\ActiveRecord;

class PlaceImage extends ActiveRecord
{
    public $uploads;

    public function rules()
    {
        return [
            [['place_id','image','uploads'], 'required'],
            [['place_id'], 'integer'],
            [['image'],'string'],
            [['uploads'], 'file', 'extensions'=>['png', 'jpg', 'gif'], 'maxSize' => 1024*1024] //todo возможно создать встроенный валидатор или как то вынести код
        ];
    }

    public function getPlace()
    {
        return $this->hasOne(Place::class, ['id' => 'place_id']);
    }
}