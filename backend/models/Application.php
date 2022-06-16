<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;

/**
 * Класс "Заявка"
 * Attributes:
 * @property int $id - ID
 * @property int $user_id - Пользователь(ID)
 * @property int $num - Кол-во
 * @property int $status_id - Статус (ID)
 * @property int $ticket_id - Билет (ID)
 * Relations:
 * @property User $user - Пользователь
 * @property Ticket[] $tickets - Билеты
 * @property Status $status - Статус
 */
class Application extends ActiveRecord
{
    /** @inheritdoc */
    public function rules(): array
    {
        return [
            [['user_id', 'num', 'status_id'], 'required'],
            [['user_id', 'num', 'status_id'], 'integer']
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getTicketApplications(): ActiveQuery
    {
        return $this->hasMany(TicketApplication::class, ['application_id' => 'id']);
    }

    public function getTickets(): ActiveQuery
    {
        return $this->hasMany(Ticket::class, ['id' => 'ticket_id'])->via('ticketApplications');
    }

    /**
     * @return ActiveQuery
     */
    public function getStatus(): ActiveQuery
    {
        return $this->hasOne(Status::class, ['id' => 'status_id']);
    }

    /** @inheritdoc */
    public function fields(): array
    {
        $fields = parent::fields();
        $fields['status_name'] = function () {
            return $this->status->name;
        };
        $fields['tickets'] = function (){
            return $this->tickets;
        };
        return $fields;
    }
}
