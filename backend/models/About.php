<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Модель "О нас"
 * @property int $id - ID
 * @property string $text - Крупный текст (заголовок)
 * @property string $small_text - Мелкий текст
 * @property string $image - изображение
 */
class About extends ActiveRecord
{
    public function rules(): array
    {
        return [
            [['text', 'small_text', 'image'], 'required'],
            [['text', 'small_text', 'image'], 'string'],
        ];
    }
}
