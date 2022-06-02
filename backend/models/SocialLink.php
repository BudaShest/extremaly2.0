<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Модель 'Социальная сеть (проекта)'
 *
 * @property int $id - ID
 * @property string $title - Заголовок
 * @property string $icon - Иконка
 * @property string $url - Ссылка
 */
class SocialLink extends ActiveRecord
{
    /** @inheritdoc */
    public function rules(): array
    {
        return [
            [['title', 'icon', 'url'], 'required'],
            [['title', 'icon', 'url'], 'string'],
        ];
    }
}
