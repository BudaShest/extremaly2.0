<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;

class Climat extends ActiveRecord
{
    public function rules(): array
    {
        return [
            [['code', 'name', 'icon'], 'required'],
            [['code', 'name', 'icon'], 'string'],
            [['code', 'name'], 'unique'],
        ];
    }


    public function getPlaces(): ActiveQuery
    {
        return $this->hasMany(Place::class, ['climat_code' => 'code']);
    }
}