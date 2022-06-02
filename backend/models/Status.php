<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Модель "Статус (Заказа)"
 * Attributes:
 * @property int $id
 * @property string $name - Имя
 * Relations:
 * @property Application $applications
 */
class Status extends ActiveRecord
{
    /** @inheritdoc */
    public function rules(): array
    {
        return [
            [['name'], 'required'],
            [['name'], 'string'],
            [['name'], 'unique']
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getApplications(): ActiveQuery
    {
        return $this->hasMany(Application::class, ['status_id' => 'status']);
    }
}
