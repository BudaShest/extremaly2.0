<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Модель "Отзыв (к проекту)"
 * Attributes:
 * @property int $id - ID
 * @property int $user_id - Пользователь(ID)
 * @property string $text - Текст отзыва
 * @property int $rating - Рейтинг
 * Relations:
 * @property User $user - Пользователь, оставивший отзыв
 */
class Review extends ActiveRecord
{
    /** @inheritdoc */
    public function rules(): array
    {
        return [
            [['user_id', 'text'], 'required'],
            [['user_id', 'rating'], 'integer'],
            [['text'], 'string'],
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /** @inheritdoc  */
    public function fields(): array
    {
        $fields = parent::fields();
        $fields['avatar'] = function () {
            return $this->user->avatar;
        };
        $fields['user_login'] = function () {
            return $this->user->login;
        };
        return $fields;
    }
}
