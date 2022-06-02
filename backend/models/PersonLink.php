<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;

/**
 * Модель "Соц. сеть личности"
 * @property int $person_id
 * @property string $title
 * @property string $icon
 * @property string $url
 * @property Person $person
 */
class PersonLink extends ActiveRecord
{
    /** @inheritdoc */
    public function rules(): array
    {
        return [
            [['person_id', 'title', 'icon', 'url'], 'required'],
            [['title', 'icon', 'url'], 'string'],
            [['person_id'], 'integer']
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
