<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;

/**
 * Модель "Изображения места"
 * @property int $place_id - ID места
 * @property string $image - Изображение
 * @property int $id - ID
 * Relations:
 * @property Place $place
 */
class PlaceImage extends ActiveRecord
{
    /** @var string Внешний ключ */
    public const MODEL_FK = 'place_id';

    /** @inheritdoc */
    public function rules(): array
    {
        return [
            [['place_id', 'image'], 'required'],
            [['place_id'], 'integer'],
            [['image'], 'string'],
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getPlace(): ActiveQuery
    {
        return $this->hasOne(Place::class, ['id' => 'place_id']);
    }
}
