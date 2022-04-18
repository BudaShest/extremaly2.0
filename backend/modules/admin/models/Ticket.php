<?php

namespace app\modules\admin\models;

use app\models\Ticket as BaseTicket;

class Ticket extends BaseTicket
{
    public function attributeLabels(): array
    {
        return [
            'event_id' => 'Событие',
            'privilege' => 'Привилегии',
            'price' => 'Цена',
        ];
    }
}
