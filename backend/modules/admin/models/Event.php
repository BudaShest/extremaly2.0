<?php

namespace app\modules\admin\models;

use app\models\Event as BaseEvent;
use app\modules\admin\behaviors\MultiFileBehavior;
use app\models\EventImage;

class Event extends BaseEvent
{
    public $uploads;

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors[] = [
            'class' => MultiFileBehavior::class,
            'model' => $this,
            'imageClass' => EventImage::class,
            'fileField' => 'flag'
        ];
        return $behaviors;
    }

    public function rules(): array
    {
        $rules = parent::rules();
        $rules[] = [['uploads'], 'file', 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => 1024 * 1024]; //todo возможно создать встроенный валидатор или как то вынести код
        return $rules;
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'offer' => 'Оффер',
            'from' => 'Дата начала',
            'until' => 'Дата конца',
            'description' => 'Описание',
            'age_restrictions' => 'Возрастные ограничения',
            'priority' => 'Приоритет',
            'is_horizontal' => 'Горизонтальная ли?',
            'place_id' => 'Место',
            'type_id' => 'Тип событий',
            'uploads' => 'Изображения'
        ];
    }
}