<?php

namespace app\modules\admin\models;

use app\models\Place as BasePlace;
use app\models\PlaceImage;
use app\modules\admin\behaviors\MultiFileBehavior;

class Place extends BasePlace
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors[] = [
            'class' => MultiFileBehavior::class,
            'model' => $this,
            'imageClass' => PlaceImage::class,
        ];
        return $behaviors;
    }

    //todo сделать также в других модельках модуля
    /** @var string  */
    public const MODEL_NAME_RU = 'Место';
    /** @var string  */
    public const MODEL_NAME_RU_MULTI = 'Места';

    public $uploads;

    /** @inheritDoc */
    public function rules(): array
    {
        $rules = parent::rules();
        $rules[] = [['uploads'], 'file', 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => 1024 * 1024 * 10, 'maxFiles' => 9];
        return $rules;
    }

    /** @inheritDoc */
    public function attributeLabels(): array
    {
        return [
            'name' => 'Название',
            'address' => 'Адрес',
            'description' => 'Описание',
            'climat_code' => 'Климат',
            'country_code' => 'Страна',
            'uploads' => 'Файлы изображений'
        ];
    }
}