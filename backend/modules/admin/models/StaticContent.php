<?php

namespace app\modules\admin\models;

use app\modules\admin\behaviors\SingleFileBehavior;
use app\models\StaticContent as BaseStaticContent;

class StaticContent extends BaseStaticContent
{
    public $uploads;

    public const DEFAULT_IMAGE = 'https://www.wheretowillie.com/wp-content/uploads/2012/08/Under-the-Stars.jpg';

    public function rules(): array
    {
        $rules = parent::rules();
        $rules[] = [['uploads'], 'file', 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => 1024 * 1024 * 12];
        return $rules;
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors[] = [
            'class' => SingleFileBehavior::class,
            'model' => $this,
            'fileField' => 'image',
        ];
        return $behaviors;
    }

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