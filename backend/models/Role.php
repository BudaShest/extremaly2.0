<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;

/**
 * Модель "Роль (пользователя)"
 * Attributes:
 * @property int $id - ID
 * @property string $name - Имя
 * Relations:
 * @property User $users
 */
class Role extends ActiveRecord
{
    /** @var int Роль по умолч. */
    public const DEFAULT_ROLE_ID = 3;

    /** @var int Роль администратора */
    public const ADMIN_ROLE_ID = 1;

    /** @inheritDoc */
    public function rules(): array
    {
        return [
            [['name'], 'required'],
            [['name'], 'unique'],
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getUsers(): ActiveQuery
    {
        return $this->hasMany(User::class, ['role_id' => 'id']);
    }
}
