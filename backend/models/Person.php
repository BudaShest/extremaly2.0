<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;

class Person extends ActiveRecord
{
    public function rules(): array
    {
        return [
            [['firstname', 'age'], 'required'],
            [['firstname', 'lastname', 'patronymic', 'description', 'role'], 'string'],
            [['age'], 'integer']
        ];
    }

    public function getImages(): ActiveQuery
    {
        return $this->hasMany(PersonImage::class, ['person_id' => 'id']);
    }

    public function getLinks(): ActiveQuery
    {
        return $this->hasMany(PersonLink::class, ['person_id' => 'id']);
    }

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
        return $fields;
    }
}