<?php

namespace app\modules\admin\models;

use app\modules\admin\models\interfaces\IFabric;
use yii\base\Model;

class TicketGenerator extends Model implements IFabric
{
    public function rules(): array
    {
        return [
            [['number', 'event_id', 'price', 'privilege'], 'required'],
            [['number', 'event_id', 'price'], 'integer'],
            [['privilege'], 'string'],
        ];
    }

    public int $number = 0;
    public int $event_id = 0;
    public int $price = 0;
    public string $privilege = '';

    public function make()
    {
        $tickets = [];
        $number = $this->number;
        $event_id = $this->event_id;
        $price = $this->price;
        $privilege = $this->privilege;

        for ($i = 0; $i < $number; $i++) {
            $ticket = new Ticket(compact('event_id', 'price', 'privilege'));
            if(!$ticket->save()){
                return false;
            }
            $tickets[] = $ticket;
        }
        return $tickets;
    }
}
