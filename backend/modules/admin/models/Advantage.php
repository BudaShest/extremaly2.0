<?php

namespace app\modules\admin\models;
use app\models\Advantage as BaseAdvantage;

class Advantage extends BaseAdvantage
{
    public function attributeLabels(): array
    {
        return [
            'title' => 'Заголовок',
            'text' => 'Текст',
        ];
    }
}
