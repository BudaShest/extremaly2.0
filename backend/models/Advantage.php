<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Модель "Преимущество"
 * @property string $title - Заголовок
 * @property string $text - Текст
 */
class Advantage extends ActiveRecord
{
    /** @inheritdoc */
    public function rules(): array
    {
        return [
            [['title', 'text'], 'required'],
            [['title', 'text'], 'string']
        ];
    }
}
