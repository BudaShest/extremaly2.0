<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;

class EventReview extends ActiveRecord
{
    public function rules(): array
    {
        return [
            [['user_id', 'event_id', 'text'], 'required'],
            [['user_id', 'event_id', 'rating'], 'integer'],
            [['text'], 'string'],
            [['created_at'], 'datetime']
        ];
    }

    public function getEvent(): ActiveQuery
    {
        return $this->hasOne(Event::class, ['id' => 'event_id']);
    }

    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}