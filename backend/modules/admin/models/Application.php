<?php

namespace app\modules\admin\models;

use app\models\Application as BaseApplication;

class Application extends BaseApplication
{
    public function attributeLabels(): array
    {
        return [
            'user_id' => 'Пользователь',
            'ticket_id' => 'Билет',
            'num' => 'Кол-во',
            'status_id' => 'Статус'
        ];
    }

}
