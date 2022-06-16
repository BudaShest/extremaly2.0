<?php

namespace app\modules\admin\models;

use app\models\PersonLink as BasePersonLink;
use app\modules\admin\behaviors\SingleFileBehavior;
use yii\web\UploadedFile;

/** @inheritdoc */
final class PersonLink extends BasePersonLink
{
    /** @var ?UploadedFile $uploads */
    public ?UploadedFile $uploads = null;

    /** @var string Изображение заглушка */
    public const DEFAULT_IMAGE = 'http://s1.iconbird.com/ico/0912/MetroUIDock/w512h5121347464753Network.png';

    /** @inheritdoc */
    public function rules(): array
    {
        $rules = parent::rules();
        $rules[] = [['uploads'], 'file', 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => 1024 * 1024 * 4];
        return $rules;
    }

    /** @inheritdoc */
    public function behaviors(): array
    {
        $behaviors = parent::behaviors();
        $behaviors[] = [
            'class' => SingleFileBehavior::class,
            'model' => $this,
            'fileField' => 'icon',
        ];
        return $behaviors;
    }

    /** @inheritdoc */
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
