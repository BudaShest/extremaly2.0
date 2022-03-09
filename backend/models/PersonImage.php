<?php

use yii\db\ActiveRecord;

class PersonImage extends ActiveRecord
{
    public $uploads;

    public function rules()
    {
        return [
          [['person_id', 'image', 'uploads'], 'required'],
          [['person_id'], 'integer'],
          [['image'], 'string'],
          [['uploads'], 'file', 'extensions'=>['png', 'jpg', 'gif'], 'maxSize' => 1024*1024] //todo возможно создать встроенный валидатор или как то вынести код
        ];
    }

    public function getPerson()
    {
        return $this->hasOne(Person::class, ['id'  => 'person_id']);
    }
}