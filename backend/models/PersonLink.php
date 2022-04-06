<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;

class PersonLink extends ActiveRecord
{
    public function rules()
    {
        return [
            [['person_id','title','icon', 'url'], 'required'],
            [['title','icon', 'url'], 'string'],
            [['person_id'], 'integer']
        ];
    }

    public function getPerson(): ActiveQuery
    {
        return $this->hasOne(Person::class, ['id' => 'person_id']);
    }

}