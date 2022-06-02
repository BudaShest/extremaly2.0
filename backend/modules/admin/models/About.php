<?php

namespace app\modules\admin\models;

use app\models\About as BaseAbout;
use app\modules\admin\behaviors\SingleFileBehavior;
use yii\web\UploadedFile;

/**
 * @inheritdoc
 * @property UploadedFile $uploads
 */
class About extends BaseAbout
{
    /** @var UploadedFile $uploads - загрузки */
    public UploadedFile $uploads;

    /** @var string Изображение заглушка */
    public const DEFAULT_IMAGE = 'https://www.wheretowillie.com/wp-content/uploads/2012/08/Under-the-Stars.jpg';

    /** @inheritdoc */
    public function rules(): array
    {
        $rules = parent::rules();
        $rules[] = [['uploads'], 'file', 'extensions' => ['png', 'jpg', 'gif', 'jpeg'], 'maxSize' => 1024 * 1024 * 12];
        return $rules;
    }

    /** @inheritdoc */
    public function attributeLabels(): array
    {
        return [
            'text' => 'Текст',
            'small_text' => 'Доп. текст',
            'image' => 'Картинка',
            'uploads' => 'Картинка'
        ];
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
}
