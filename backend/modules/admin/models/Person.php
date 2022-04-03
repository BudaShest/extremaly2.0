<?php

namespace app\modules\admin\models;

use app\models\Person as BasePerson;
use app\models\PersonImage;
use app\modules\admin\behaviors\MultiFileBehavior;

class Person extends BasePerson
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors[] = [
            'class' => MultiFileBehavior::class,
            'model' => $this,
            'imageClass' => PersonImage::class,
            'fileField' => 'flag'
        ];
        return $behaviors;
    }

    /** @inheritDoc */
    public function rules(): array
    {
        $rules = parent::rules();
        $rules[] = [['uploads'], 'file', 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => 1024 * 1024 * 10];
        return $rules;
    }

    public $uploads;

    public function attributeLabels(): array
    {
        return [
          'firstname' => 'Имя',
          'lastname' => 'Фамилия',
          'patronymic' => 'Отчество',
          'age' => 'Возраст',
          'description' => 'Описание',
          'profession' => 'Профессия'
        ];
    }
}