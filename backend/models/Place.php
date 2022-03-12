<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;

class Place extends ActiveRecord
{
    public function rules(): array
    {
        return [
            [['name', 'address', 'description', 'country_code', 'climat_code'], 'required'],
            [['name', 'address', 'description'], 'string'],
            [['name', 'address'], 'unique']
        ];
    }

    public function getCountry(): ActiveQuery
    {
        return $this->hasOne(Country::class, ['code' => 'country_code']);
    }

    public function getClimat(): ActiveQuery
    {
        return $this->hasOne(Climat::class, ['code' => 'climat_code']);
    }

    public function getImages(): ActiveQuery
    {
        return $this->hasMany(PlaceImage::class, ['place_id' => 'id']);
    }

    public function getEvents(): ActiveQuery
    {
        return $this->hasMany(Event::class, ['place_id' => 'id']);
    }
}