<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;

class Climat extends ActiveRecord
{
    //TODO уточнить тип и потом чекнуть все AR-модели
    public $uploads;

    public function rules(): array
    {
        return [
//          [['code', 'name', 'icon','uploads'], 'required'],
            [['code', 'name', 'icon'], 'required'],
            [['code', 'name', 'icon'], 'string'],
            [['code', 'name'], 'unique'],
//            [['uploads'], 'file', 'extensions'=>['png', 'jpg', 'gif'], 'maxSize' => 1024*1024] //todo возможно создать встроенный валидатор или как то вынести код
        ];
    }


    public function getPlaces(): ActiveQuery
    {
        return $this->hasMany(Place::class, ['climat_code' => 'code']);
    }
}