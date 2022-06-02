<?php

namespace app\modules\admin\models;

use app\modules\admin\behaviors\SingleFileBehavior;
use app\models\StaticContent as BaseStaticContent;
use yii\web\UploadedFile;

/** @inheritdoc */
final class StaticContent extends BaseStaticContent
{
    /** @var UploadedFile $uploads - загрузки */
    public UploadedFile $uploads;

    /** @var string Изображение-заглушка */
    public const DEFAULT_IMAGE = 'https://www.wheretowillie.com/wp-content/uploads/2012/08/Under-the-Stars.jpg';

    /** @inheritdoc */
    public function rules(): array
    {
        $rules = parent::rules();
        $rules[] = [['uploads'], 'file', 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => 1024 * 1024 * 12];
        return $rules;
    }

    /** @inheritdoc */
    public function behaviors(): array
    {
        $behaviors = parent::behaviors();
        $behaviors[] = [
            'class' => SingleFileBehavior::class,
            'model' => $this,
            'fileField' => 'image',
        ];
        return $behaviors;
    }

    /** @inheritdoc */
    public function attributeLabels(): array
    {
        return [
            'image' => 'Картинки',
            'title' => 'Заголовок',
            'text' => 'Текст',
            'uploads' => 'Картинки',
        ];
    }
}
