<?php

use yii\db\ActiveRecord;

class Application extends ActiveRecord
{
    public function rules()
    {
        return [
          [['user_id', 'ticket_id', 'num', 'status_id'], 'required'],
          [['user_id', 'ticket_id', 'num', 'status_id'], 'integer']
        ];
    }

    public function getApplication()
    {

    }
}