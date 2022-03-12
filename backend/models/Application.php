<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;

class Application extends ActiveRecord
{
    public function rules(): array
    {
        return [
            [['user_id', 'ticket_id', 'num', 'status_id'], 'required'],
            [['user_id', 'ticket_id', 'num', 'status_id'], 'integer']
        ];
    }

    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getTickets(): ActiveQuery //TODO вот тут продумать другой тип связи наверное (возможно добавить промежточную таблицу)
    {
//        return $this->hasMany(Ticket::class, ['id' => э])
    }

    public function getStatus(): ActiveQuery
    {
        return $this->hasOne(Status::class, ['id' => 'status_id']);
    }
}