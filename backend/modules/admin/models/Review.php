<?php

namespace app\modules\admin\models;
use app\models\Review as BaseEventReview;

class Review extends BaseEventReview
{
    /** @inheritDoc */
    public function attributeLabels()
    {
        return [
            'user_id' => 'Пользователь',
            'text' => 'Текст',
            'rating' => 'Рейтинг'
        ];
    }
}
