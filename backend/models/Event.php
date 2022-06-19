<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;

/**
 * Модель "Событие"
 * @property int $id - ID
 * @property string $name - Имя
 * @property string $offer - Оффер
 * @property \DateTime $from - Дата начала
 * @property \DateTime $until - Дата конца
 * @property string $description - Описание
 * @property int $age_restrictions - Возрастные ограничения
 * @property int $priority - Приоритет
 * @property bool $is_horizontal - Горизонтальная ли?
 * @property int $place_id - Место
 * @property int $type_id - Тип событий
 * @property int $ticket_num - Билетов всего
 * @property Place $place - Место
 * @property EventType $type - Тип события
 * @property EventImage $images - Изображение события
 * @property Ticket $tickets - Билет
 */
class Event extends ActiveRecord
{
    /** @inheritdoc */
    public function rules(): array
    {
        return [
            [['name', 'place_id', 'type_id',], 'required'],
            [['name', 'offer', 'description'], 'string'],
//            [['from'], 'date', 'format' => 'php:Y.m.d', 'timestampAttribute' => 'from'],
//            [['until'], 'date', 'format' => 'php:Y.m.d', 'timestampAttribute' => 'until'],
            [['from'], 'safe'], //пока костылим //todo
            [['until'], 'safe'], //пока костыим
            [['age_restrictions', 'priority', 'place_id', 'type_id', 'ticket_num'], 'integer'],
            [['is_horizontal'], 'boolean'],
            [['name'], 'unique'],
        ];
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
        $fields['place_name'] = function () {
            return $this->place->name;
        };
        $fields['type_name'] = function () {
            return $this->type->name;
        };
        $fields['country_name'] = function () {
            return $this->place->country->name;
        };
        $fields['climat_name'] = function () {
            return $this->place->climat->name;
        };
        return $fields;
    }

    /**
     * @return ActiveQuery
     */
    public function getPlace(): ActiveQuery
    {
        return $this->hasOne(Place::class, ['id' => 'place_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getType(): ActiveQuery
    {
        return $this->hasOne(EventType::class, ['id' => 'type_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getImages(): ActiveQuery
    {
        return $this->hasMany(EventImage::class, ['event_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getTickets(): ActiveQuery
    {
        return $this->hasMany(Ticket::class, ['event_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function getPersons(): ActiveQuery
    {
        return $this->hasMany(Person::class, ['id' => 'person_id'])->viaTable('event_person', ['event_id' => 'id']);
    }

    /** @inheritdoc  */
    public function load($data, $formName = null)
    {
//        var_dump($data);die;
//        $data['Event']['from'] = strtotime($data['Event']['from']);
//        $data['Event']['until'] = strtotime($data['Event']['until']);
        if ($data) {
//            $data['Event']['from'] = date('Y-m-d', strtotime($data['Event']['from']));
//            $data['Event']['until'] = date('Y-m-d', strtotime($data['Event']['until']));
//            var_dump($data['Event']);die;
            return parent::load($data, $formName);
        }
    }
}
