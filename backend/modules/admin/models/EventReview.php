<?php

namespace app\modules\admin\models;

use app\models\EventReview as BaseEventReview;

/** @inheritdoc */
final class EventReview extends BaseEventReview
{
    /** @inheritDoc */
    public function attributeLabels(): array
    {
        return [
            'user_id' => 'Пользователь',
            'event_id' => 'Событие',
            'text' => 'Текст',
            'rating' => 'Рейтинг'
        ];
    }
}
