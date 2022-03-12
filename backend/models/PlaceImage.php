<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;

class PlaceImage extends ActiveRecord
{
    public $uploads;

    public function rules(): array
    {
        return [
            [['place_id', 'image', 'uploads'], 'required'],
            [['place_id'], 'integer'],
            [['image'], 'string'],
            [['uploads'], 'file', 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => 1024 * 1024] //todo возможно создать встроенный валидатор или как то вынести код
        ];
    }

    public function getPlace(): ActiveQuery
    {
        return $this->hasOne(Place::class, ['id' => 'place_id']);
    }
}