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
    /** @var int Статус заявки "В рассмотрении" */
    public const DEFAULT_STATUS_ID = 1;

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
