<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

class Banned extends ActiveRecord
{
    public function rules(): array
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'unique'],
            [['reason'], 'string'],
            [['user_id'], 'integer'],
        ];
    }

    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id'=>'user_id']);
    }
}