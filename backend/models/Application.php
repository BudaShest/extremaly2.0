<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;

class Application extends ActiveRecord
{
    public function rules(): array
    {
        return [
            [['user_id', 'num', 'status_id'], 'required'],
            [['user_id', 'num', 'status_id'], 'integer']
        ];
    }

    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getTickets(): ActiveQuery
    {
        return $this->hasMany(Ticket::class, ['id' => 'ticket_id'])->viaTable('ticket_application',['application_id' => 'id']);
    }

    public function getStatus(): ActiveQuery
    {
        return $this->hasOne(Status::class, ['id' => 'status_id']);
    }

    public function fields()
    {
        $fields = parent::fields();
        $fields['status_name'] = function ($data){
            return $this->status->name;
        };
        return $fields;
    }
}
