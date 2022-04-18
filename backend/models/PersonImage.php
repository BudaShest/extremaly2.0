<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;

class PersonImage extends ActiveRecord
{
    public const MODEL_FK = 'person_id';

    public function rules(): array
    {
        return [
            [['person_id', 'image'], 'required'],
            [['person_id'], 'integer'],
            [['image'], 'string'],
        ];
    }

    public function getPerson(): ActiveQuery
    {
        return $this->hasOne(Person::class, ['id' => 'person_id']);
    }
}
