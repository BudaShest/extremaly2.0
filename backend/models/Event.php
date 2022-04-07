<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;

class Event extends ActiveRecord
{
    public function rules(): array
    {
        return [
            [['name', 'place_id', 'type_id'], 'required'],
            [['name', 'offer', 'description'], 'string'],
            [['from'], 'date', 'format' => 'php:d.m.Y', 'timestampAttribute' => 'from'],
            [['until'], 'date', 'format' => 'php:d.m.Y', 'timestampAttribute' => 'until'],
            [['age_restrictions', 'priority', 'place_id', 'type_id'], 'integer'],
            [['is_horizontal'], 'boolean'],
            [['name'], 'unique'],
        ];
    }

    public function fields(): array
    {
        $fields = parent::fields();
        $fields['images'] = function (){
            $images = [];
            foreach ($this->images as $image){
                $images[] = $image['image'];
            }
            return $images;
        };
        $fields['place_name'] = function (){
            return $this->place->name;
        };
        $fields['type_name'] = function (){
            return $this->type->name;
        };
        $fields['country_name'] = function (){
            return $this->place->country->name;
        };
        $fields['climat_name'] = function (){
            return $this->place->climat->name;
        };
        return $fields;
    }

    public function getPlace(): ActiveQuery
    {
        return $this->hasOne(Place::class, ['id' => 'place_id']);
    }

    public function getType(): ActiveQuery
    {
        return $this->hasOne(EventType::class, ['id' => 'type_id']);
    }

    public function getImages(): ActiveQuery
    {
        return $this->hasMany(EventImage::class, ['event_id' => 'id']);
    }

    public function getTickets(): ActiveQuery
    {
        return $this->hasMany(Ticket::class, ['event_id' => 'id']);
    }

    public function getPersons(): ActiveQuery
    {
        return $this->hasMany(Person::class, ['id' => 'person_id'])->viaTable('event_person', ['event_id'=>'id']);
    }
}