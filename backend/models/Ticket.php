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
 * @property Application[] $applications
 * @property TicketApplication[] $ticketApplications
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
     */
    public function getTicketApplications(): ActiveQuery
    {
        return $this->hasMany(TicketApplication::class, ['ticket_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getApplications(): ActiveQuery
    {
        return $this->hasMany(Application::class, ['id' => 'application_id'])->via('ticketApplications');
    }

    /** @inheritdoc */
    public function fields(): array
    {
        $fields = parent::fields();
        $fields['event_name'] = function () {
            return $this->event->name;
        };
        $fields['ticket_applications'] = function () {
            return $this->ticketApplications;
        };
        return $fields;
    }
}
