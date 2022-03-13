<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;

class Country extends ActiveRecord
{
    public function rules(): array
    {
        return [
            [['code', 'name', 'flag'], 'required'],
            [['code', 'name'], 'unique'],
            [['code'], 'string'],
            [['name'], 'string'],
        ];
    }

    public function getPlaces(): ActiveQuery
    {
        return $this->hasMany(Place::class, ['country_code' => 'code']);
    }
}