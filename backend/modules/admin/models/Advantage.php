<?php

namespace app\modules\admin\models;

use app\models\Advantage as BaseAdvantage;

/** @inheritdoc */
class Advantage extends BaseAdvantage
{
    /** @inheritdoc */
    public function attributeLabels(): array
    {
        return [
            'title' => 'Заголовок',
            'text' => 'Текст',
        ];
    }
}
