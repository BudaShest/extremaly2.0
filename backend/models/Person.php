<?php

use yii\db\ActiveRecord;

class Person extends ActiveRecord
{
    public function rules()
    {
        return [
          [['firstname', 'age'], 'required'],
          [['firstname', 'lastname', 'description', 'profession'], 'string'],
          [['age'], 'integer']
        ];
    }

    public function getImages()
    {
        return $this->hasMany(PersonImage::class, ['person_id' => 'id']);
    }
}