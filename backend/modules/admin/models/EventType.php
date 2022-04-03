<?php

namespace app\modules\admin\models;

use app\models\EventType as BaseEventType;
use app\modules\admin\behaviors\SingleFileBehavior;
use app\modules\admin\models\interfaces\IFileWorkable;

class EventType extends BaseEventType
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors[] = [
            'class' => SingleFileBehavior::class,
            'model' => $this,
            'fileField' => 'icon'
        ];
        return $behaviors;
    }

    public $uploads;

    public function rules(): array
    {
        $rules = parent::rules();
        $rules[] = [['uploads'], 'file', 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => 1024 * 1024]; //todo возможно создать встроенный валидатор или как то вынести код
        return $rules;
    }

    public function attributeLabels(): array
    {
        return [
            'name' => 'Имя',
            'uploads' => 'Иконка'
        ];
    }
}