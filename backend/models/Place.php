<?php

use yii\db\ActiveRecord;


class Place extends ActiveRecord
{
    public function rules()
    {
        return [
          [['name','address','description','country_code','climat_code'],'required'],
          [['name','address','description'],'string'],
          [['name', 'address'], 'unique']
        ];
    }

    public function getCountry()
    {
        return $this->hasOne(Country::class, ['code' => 'country_code']);
    }

    public function getClimat()
    {
        return $this->hasOne(Climat::class, ['code' => 'climat_code']);
    }

    public function getImages()
    {
        return $this->hasMany(PlaceImage::class, ['place_id' => 'id']);
    }

    public function getEvents()
    {
        return $this->hasMany(Event::class, ['place_id' => 'id']);
    }
}