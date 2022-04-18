<?php

namespace app\modules\admin\models;

use app\models\About as BaseAbout;
use app\modules\admin\behaviors\SingleFileBehavior;

class About extends BaseAbout
{
    public $uploads;

    public const DEFAULT_IMAGE = 'https://www.wheretowillie.com/wp-content/uploads/2012/08/Under-the-Stars.jpg';

    public function rules(): array
    {
        $rules = parent::rules();
        $rules[] = [['uploads'], 'file', 'extensions' => ['png', 'jpg', 'gif','jpeg'], 'maxSize' => 1024 * 1024 * 12];
        return $rules;
    }

    public function attributeLabels(): array
    {
        return [
            'text' => 'Текст',
            'small_text' => 'Доп. текст',
            'image' => 'Картинка',
            'uploads' => 'Картинка'
        ];
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
}
