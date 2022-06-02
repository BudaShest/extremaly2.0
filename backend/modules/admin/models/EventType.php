<?php

namespace app\modules\admin\models;

use app\models\EventType as BaseEventType;
use app\modules\admin\behaviors\SingleFileBehavior;
use app\modules\admin\models\interfaces\IFileWorkable;
use yii\web\UploadedFile;

/** @inheritdoc */
final class EventType extends BaseEventType
{
    /** @var string Изображение (заглушка) */
    public const DEFAULT_IMAGE = 'https://www.pngmart.com/files/8/Holiday-PNG-Free-Download.png';

    /** @inheritdoc */
    public function behaviors(): array
    {
        $behaviors = parent::behaviors();
        $behaviors[] = [
            'class' => SingleFileBehavior::class,
            'model' => $this,
            'fileField' => 'icon'
        ];
        return $behaviors;
    }

    /** @var UploadedFile $uploads - загрузки */
    public UploadedFile $uploads;

    /** @inheritdoc */
    public function rules(): array
    {
        $rules = parent::rules();
        $rules[] = [['uploads'], 'file', 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => 1024 * 1024 * 5];
        return $rules;
    }

    /** @inheritdoc */
    public function attributeLabels(): array
    {
        return [
            'name' => 'Имя',
            'uploads' => 'Иконка',
            'icon' => 'Иконка',
        ];
    }
}
