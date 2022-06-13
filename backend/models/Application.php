<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\ActiveQuery;

/**
 * Класс "Заявка"
 * Attributes:
 * @property int $user_id - Пользователь(ID)
 * @property int $num - Кол-во
 * @property int $status_id - Статус (ID)
 * @property int $ticket_id - Билет (ID)
 * Relations:
 * @property User $user - Пользователь
 * @property Ticket $tickets - Билеты
 * @property Status $status - Статус
 */
class Application extends ActiveRecord
{
    /** @inheritdoc */
    public function rules(): array
    {
        return [
            [['user_id', 'num', 'status_id'], 'required'],
            [['user_id', 'num', 'status_id'], 'integer']
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * @return ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function getTickets(): ActiveQuery
    {
        return $this->hasMany(Ticket::class, ['id' => 'ticket_id'])->viaTable('ticket_application', ['application_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getStatus(): ActiveQuery
    {
        return $this->hasOne(Status::class, ['id' => 'status_id']);
    }

    /** @inheritdoc */
    public function fields(): array
    {
        $fields = parent::fields();
        $fields['status_name'] = function () {
            return $this->status->name;
        };
        return $fields;
    }
}
