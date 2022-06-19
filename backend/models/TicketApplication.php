<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Модель, связывающая билеты и заявки
 * Attributes:
 * @property int $id - ID
 * @property int $application_id - ID заявки
 * @property int $ticket_id - ID билета
 * @property int $num - кол-во билетов определённого типа я заявке
 * Relations:
 * @property Ticket $ticket
 * @property Application $application
 */
class TicketApplication extends ActiveRecord
{
    /** @inheritdoc */
    public function rules(): array
    {
        return [
            [['application_id', 'ticket_id', 'num'], 'required']
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getTicket(): ActiveQuery
    {
        return $this->hasOne(Ticket::class, ['id' => 'ticket_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getApplication(): ActiveQuery
    {
        return $this->hasOne(Application::class, ['id' => 'application_id']);
    }
}