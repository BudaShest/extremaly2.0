<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;

/**
 * Модель "Климат"
 * @property string $code - ID
 * @property string $name - Название
 * @property string $icon - Иконка
 * @property Place $place - Места с таким климатом
 */
class Climat extends ActiveRecord
{
    /** @inheritdoc */
    public function rules(): array
    {
        return [
            [['code', 'name', 'icon'], 'required'],
            [['code', 'name', 'icon'], 'string'],
            [['code', 'name'], 'unique'],
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getPlaces(): ActiveQuery
    {
        return $this->hasMany(Place::class, ['climat_code' => 'code']);
    }
}
