<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;

/**
 * Модель "Билет"
 * Attributes:
 * @property int $event_id
 * @property int $price
 * @property string $privilege
 * Relations:
 * @property Event $event
 * @property Application $applications
 */
class Ticket extends ActiveRecord
{
    /** @inheritdoc */
    public function rules(): array
    {
        return [
            [['event_id', 'price', 'privilege'], 'required'],
            [['event_id', 'price'], 'integer'],
            [['privilege'], 'string'],
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getEvent(): ActiveQuery
    {
        return $this->hasOne(Event::class, ['id' => 'event_id']);
    }

    /**
     * @return ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function getApplications(): ActiveQuery
    {
        return $this->hasMany(Application::class,['id'=>'application_id'])->viaTable('ticket_application', ['ticket_id' => 'id']);
    }

    /** @inheritdoc */
    public function fields(): array
    {
        $fields = parent::fields();
        $fields['event_name'] = function(){
            return $this->event->name;
        };
        return $fields;
    }
}
