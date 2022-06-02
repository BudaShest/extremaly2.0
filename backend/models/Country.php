<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;

/**
 * Модель "Страна"
 * @property string $code - Код (ID)
 * @property string $name - Название
 * @property string $flag - Флаг
 * @property Place $places - Места в этой стране
 */
class Country extends ActiveRecord
{
    /** @inheritdoc */
    public function rules(): array
    {
        return [
            [['code', 'name', 'flag'], 'required'],
            [['code', 'name'], 'unique'],
            [['code'], 'string'],
            [['name'], 'string'],
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getPlaces(): ActiveQuery
    {
        return $this->hasMany(Place::class, ['country_code' => 'code']);
    }
}
