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
        ];
    }

    public function fields()
    {
        $fields = parent::fields();
        $fields['user_login'] = function(){
            return $this->user->login;
        };
        $fields['avatar'] = function(){
            return $this->user->avatar;
        };
        return $fields;
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
