<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;

class PlaceImage extends ActiveRecord
{
    public const MODEL_FK = 'place_id';

    public function rules(): array
    {
        return [
            [['place_id', 'image'], 'required'],
            [['place_id'], 'integer'],
            [['image'], 'string'],
        ];
    }

    public function getPlace(): ActiveQuery
    {
        return $this->hasOne(Place::class, ['id' => 'place_id']);
    }
}