<?php

namespace app\modules\admin\models;

use app\models\Person as BasePerson;
use app\models\PersonImage;
use app\modules\admin\behaviors\MultiFileBehavior;
use yii\web\UploadedFile;

final class Person extends BasePerson
{
    /** @inheritdoc */
    public function behaviors(): array
    {
        $behaviors = parent::behaviors();
        $behaviors[] = [
            'class' => MultiFileBehavior::class,
            'model' => $this,
            'imageClass' => PersonImage::class,
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

    /** @var UploadedFile[] $uploads - Загрузки */
    public array $uploads;

    /** @inheritdoc */
    public function attributeLabels(): array
    {
        return [
            'firstname' => 'Имя',
            'lastname' => 'Фамилия',
            'patronymic' => 'Отчество',
            'age' => 'Возраст',
            'description' => 'Описание',
            'role' => 'Роль личности в событиях',
        ];
    }
}
