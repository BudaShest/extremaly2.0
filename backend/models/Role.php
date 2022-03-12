<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;

class Role extends ActiveRecord
{
    public function rules(): array
    {
        return [
            [['name'], 'required'],
            [['name'], 'unique'],
        ];
    }

    public function getUsers(): ActiveQuery
    {
        return $this->hasMany(User::class, ['role_id' => 'id']);
    }

}