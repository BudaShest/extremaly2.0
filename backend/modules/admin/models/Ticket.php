<?php

namespace app\modules\admin\models;

use app\models\Ticket as BaseTicket;

/** @inheritdoc  */
final class Ticket extends BaseTicket
{
    /** @inheritdoc */
    public function attributeLabels(): array
    {
        return [
            'event_id' => 'Событие',
            'privilege' => 'Привилегии',
            'price' => 'Цена',
        ];
    }
}
