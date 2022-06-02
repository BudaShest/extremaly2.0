<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Модель "Статичный контент"
 * @property int $id - ID
 * @property string $image - Изображение
 * @property string $title - Заголовок
 * @property string $text - Текст
 */
class StaticContent extends ActiveRecord
{
    /** @inheritdoc */
    public function rules(): array
    {
        return [
            [['image', 'title', 'text'], 'required'],
            [['image', 'title', 'text'], 'string']
        ];
    }
}
