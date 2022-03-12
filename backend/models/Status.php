<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

class Status extends ActiveRecord
{
    public function rules(): array
    {
        return [
            [['name'], 'required'],
            [['name'], 'string'],
            [['name'], 'unique']
        ];
    }

    public function getApplications(): ActiveQuery
    {
        return $this->hasMany(Application::class, ['status_id' => 'status']);
    }
}