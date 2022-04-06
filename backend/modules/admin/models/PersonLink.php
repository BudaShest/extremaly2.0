<?php

namespace app\modules\admin\models;
use app\models\PersonLink as BasePersonLink;
use app\modules\admin\behaviors\SingleFileBehavior;

class PersonLink extends BasePersonLink
{
    public $uploads;

    public const DEFAULT_IMAGE = 'http://s1.iconbird.com/ico/0912/MetroUIDock/w512h5121347464753Network.png';

    public function rules(): array
    {
        $rules = parent::rules();
        $rules[] = [['uploads'], 'file', 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => 1024 * 1024 * 4];
        return $rules;
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors[] = [
            'class' => SingleFileBehavior::class,
            'model' => $this,
            'fileField' => 'icon',
        ];
        return $behaviors;
    }

    public function attributeLabels(): array
    {
        return [
            'person_id' => 'Личность',
            'title' => 'Заголовок',
            'icon' => 'Иконка',
            'uploads' => 'Иконка',
        ];
    }
}