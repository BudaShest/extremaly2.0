<?php

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;

class Country extends ActiveRecord
{
    //уточнить тип
    public $uploads;

    public function rules(): array
    {
        return [
          [['code', 'name', 'flag', 'uploads'], 'required'],
            [['code', 'name'], 'unique'],
            [['code'], 'string', 'maxLength'=>2],
            [['name'], 'string', 'maxLength'=>64],
            [['uploads'], 'file', 'extensions'=>['png', 'jpg', 'gif'], 'maxSize' => 1024*1024] //todo возможно создать встроенный валидатор или как то вынести код
        ];
    }

    public function getPlaces(): ActiveQuery
    {
        return $this->hasMany(Place::class, ['country_code'=>'code']);
    }
}