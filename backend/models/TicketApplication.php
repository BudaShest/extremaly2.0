<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

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