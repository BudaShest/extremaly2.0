<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;

/**
 * Модель "Отзыв к событию"
 * @property int $user_id - Пользователь(ID)
 * @property int $event_id - Событие(ID)
 * @property string $text - Текст
 * @property int $rating - Рейтинг
 * @property Event $event - Событие
 * @property User $user - Пользователь
 */
class EventReview extends ActiveRecord
{
    /** @inheritdoc */
    public function rules(): array
    {
        return [
            [['user_id', 'event_id', 'text'], 'required'],
            [['user_id', 'event_id', 'rating'], 'integer'],
            [['text'], 'string'],
        ];
    }

    /** @inheritdoc */
    public function fields(): array
    {
        $fields = parent::fields();
        $fields['user_login'] = function () {
            return $this->user->login;
        };
        $fields['avatar'] = function () {
            return $this->user->avatar;
        };
        return $fields;
    }

    /**
     * @return ActiveQuery
     */
    public function getEvent(): ActiveQuery
    {
        return $this->hasOne(Event::class, ['id' => 'event_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
