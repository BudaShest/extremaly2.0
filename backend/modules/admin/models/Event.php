<?php

namespace app\modules\admin\models;

use app\models\Event as BaseEvent;
use app\modules\admin\behaviors\MultiFileBehavior;
use app\models\EventImage;
use yii\web\UploadedFile;

/**
 * @inheritdoc
 */
final class Event extends BaseEvent
{
    /** @var UploadedFile[] Загрузки */
    public array $uploads = [];

    /** @inheritdoc */
    public function behaviors(): array
    {
        $behaviors = parent::behaviors();
        $behaviors[] = [
            'class' => MultiFileBehavior::class,
            'model' => $this,
            'imageClass' => EventImage::class,
        ];
        return $behaviors;
    }

    /** @inheritdoc */
    public function rules(): array
    {
        $rules = parent::rules();
        $rules[] = [['uploads'], 'file', 'extensions' => ['png', 'jpg', 'gif', 'jpeg'], 'maxSize' => 1024 * 1024 * 15, 'maxFiles' => 9];
        return $rules;
    }

    /** @inheritdoc */
    public function attributeLabels(): array
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
            'uploads' => 'Изображения',
            'ticket_num' => 'Билетов всего'
        ];
    }
}
