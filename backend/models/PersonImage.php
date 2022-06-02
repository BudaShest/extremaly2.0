<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;

/**
 * Модель "Изображение личности"
 * @property int $id - ID
 * @property int $peron_id - ID личности
 * @property string $image - изображение
 */
class PersonImage extends ActiveRecord
{
    /**
     * Внешний ключ
     */
    public const MODEL_FK = 'person_id';

    /** @inheritdoc */
    public function rules(): array
    {
        return [
            [['person_id', 'image'], 'required'],
            [['person_id'], 'integer'],
            [['image'], 'string'],
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getPerson(): ActiveQuery
    {
        return $this->hasOne(Person::class, ['id' => 'person_id']);
    }
}
