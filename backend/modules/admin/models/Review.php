<?php

namespace app\modules\admin\models;

use app\models\Review as BaseEventReview;

/** @inheritdoc */
final class Review extends BaseEventReview
{
    /** @inheritDoc */
    public function attributeLabels(): array
    {
        return [
            'user_id' => 'Пользователь',
            'text' => 'Текст',
            'rating' => 'Рейтинг',
            'created_at' => 'Создан'
        ];
    }
}
