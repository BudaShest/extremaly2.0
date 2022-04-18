<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;

class Ticket extends ActiveRecord
{
    public function rules(): array
    {
        return [
            [['event_id', 'price', 'privilege'], 'required'],
            [['event_id', 'price'], 'integer'],
            [['privilege'], 'string'],
        ];
    }

    public function getEvent(): ActiveQuery
    {
        return $this->hasOne(Event::class, ['id' => 'event_id']);
    }

    public function getApplications(): ActiveQuery
    {
        return $this->hasMany(Application::class,['id'=>'application_id'])->viaTable('ticket_application', ['ticket_id' => 'id']);
    }

    public function fields()
    {
        $fields = parent::fields();
        $fields['event_name'] = function(){
            return $this->event->name;
        };
        return $fields;
    }
}
