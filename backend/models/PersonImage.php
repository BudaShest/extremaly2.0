<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;

class PersonImage extends ActiveRecord
{
    public $uploads;

    public function rules(): array
    {
        return [
            [['person_id', 'image'], 'required'],
            [['person_id'], 'integer'],
            [['image'], 'string'],
            [['uploads'], 'file', 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => 1024 * 1024] //todo возможно создать встроенный валидатор или как то вынести код
        ];
    }

    public function getPerson(): ActiveQuery
    {
        return $this->hasOne(Person::class, ['id' => 'person_id']);
    }
}