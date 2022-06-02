<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;

/**
 * Модель "Личность"
 * @property int $id - ID
 * @property string $firstname - Имя
 * @property string $lastname - Фамилия
 * @property string $patronymic - Отчество
 * @property int $age - Возраст
 * @property string $description - Описание
 * @property string $role - Роль личности в событиях
 * @property
 */
class Person extends ActiveRecord
{
    /** @inheritdoc */
    public function rules(): array
    {
        return [
            [['firstname', 'age'], 'required'],
            [['firstname', 'lastname', 'patronymic', 'description', 'role'], 'string'],
            [['age'], 'integer']
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getImages(): ActiveQuery
    {
        return $this->hasMany(PersonImage::class, ['person_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getLinks(): ActiveQuery
    {
        return $this->hasMany(PersonLink::class, ['person_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function getEvents(): ActiveQuery
    {
        return $this->hasMany(Event::class, ['id' => 'event_id'])->viaTable('event_person', ['person_id' => 'id']);
    }

    /** @inheritdoc */
    public function fields(): array
    {
        $fields = parent::fields();
        $fields['images'] = function () {
            $images = [];
            foreach ($this->images as $image) {
                $images[] = $image['image'];
            }
            return $images;
        };
        $fields['links'] = function (){
            $links = [];
            foreach ($this->links as $link){
                $links[] = $link;
            }
            return $links;
        };
        return $fields;
    }
}
