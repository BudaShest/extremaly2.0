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
            [['created_at'], 'datetime']
        ];
    }

    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}