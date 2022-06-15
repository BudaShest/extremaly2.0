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



}