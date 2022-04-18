<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

class Review extends ActiveRecord
{
    public function rules(): array
    {
        return [
            [['user_id', 'text'], 'required'],
            [['user_id', 'rating'], 'integer'],
            [['text'], 'string'],
        ];
    }

    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function fields()
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
