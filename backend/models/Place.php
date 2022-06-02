<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;

/**
 * Модель "Место (проведения)"
 * @property int $id - ID
 * @property string $name - Название
 * @property string $address - Адрес
 * @property string $description - Описание
 * @property string $country_code - Страна(ID)
 * @property string $climat_code - Климат(ID)
 * Relations:
 * @property Event $events - События в этом месте
 * @property Country $country - Страна нахождения
 * @property Climat $climat - Климат
 * @property PlaceImage $images - Изображения
 */
class Place extends ActiveRecord
{
    /** @inheritdoc */
    public function rules(): array
    {
        return [
            [['name', 'address', 'description', 'country_code', 'climat_code'], 'required'],
            [['name', 'address', 'description', 'country_code', 'climat_code', 'map'], 'string'],
            [['name', 'address'], 'unique']
        ];
    }

    /** @inheritdoc */
    public function fields()
    {
        $fields = parent::fields();
        $fields['country_name'] = function () {
            return $this->country->name;
        };
        $fields['climat_name'] = function () {
            return $this->climat->name;
        };
        $fields['images'] = function () {
            $images = [];
            foreach ($this->images as $image) {
                $images[] = $image['image'];
            }
            return $images;
        };
        $fields['climat_icon'] = function () {
            return $this->climat->icon;
        };
        $fields['country_flag'] = function () {
            return $this->country->flag;
        };
        return $fields;
    }

    /**
     * @return ActiveQuery
     */
    public function getCountry(): ActiveQuery
    {
        return $this->hasOne(Country::class, ['code' => 'country_code']);
    }

    /**
     * @return ActiveQuery
     */
    public function getClimat(): ActiveQuery
    {
        return $this->hasOne(Climat::class, ['code' => 'climat_code']);
    }

    /**
     * @return ActiveQuery
     */
    public function getImages(): ActiveQuery
    {
        return $this->hasMany(PlaceImage::class, ['place_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getEvents(): ActiveQuery
    {
        return $this->hasMany(Event::class, ['place_id' => 'id']);
    }
}
