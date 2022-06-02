<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Модель "Бан"
 * @property int $id - ID
 * @property int $user_id - ID пользователя
 * @property string $reason - Причины бана
 * @property User $user - Пользователь
 */
class Banned extends ActiveRecord
{
    /** @inheritdoc */
    public function rules(): array
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'unique'],
            [['reason'], 'string'],
            [['user_id'], 'integer'],
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
