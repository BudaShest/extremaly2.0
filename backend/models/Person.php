<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;

class Person extends ActiveRecord
{
    public function rules(): array
    {
        return [
            [['firstname', 'age'], 'required'],
            [['firstname', 'lastname', 'description', 'profession'], 'string'],
            [['age'], 'integer']
        ];
    }

    public function getImages(): ActiveQuery
    {
        return $this->hasMany(PersonImage::class, ['person_id' => 'id']);
    }
}