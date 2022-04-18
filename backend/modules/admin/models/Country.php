<?php

namespace app\modules\admin\models;

use app\models\Country as BaseCountry;
use app\modules\admin\behaviors\SingleFileBehavior;

class Country extends BaseCountry
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors[] = [
            'class' => SingleFileBehavior::class,
            'model' => $this,
            'fileField' => 'flag'
        ];
        return $behaviors;
    }

    /** @var string */
    public const MODEL_NAME_RU = 'Страна';
    /** @var string */
    public const MODEL_NAME_RU_MULTI = 'Страны';

    public const DEFAULT_IMAGE = 'https://33tura.ru/FLAG/reunion.gif';

    public $uploads;

    /** @inheritDoc */
    public function rules(): array
    {
        $rules = parent::rules();
        $rules[] = [['uploads'], 'file', 'extensions' => ['png', 'jpg', 'gif','jpeg'], 'maxSize' => 1024 * 1024 * 5,];
        return $rules;
    }

    /** @inheritDoc */
    public function attributeLabels()
    {
        return [
            'code' => 'Код страны (RU, EN, US...)',
            'name' => 'Название',
            'uploads' => 'Флаг',
            'flag' => 'Флаг'
        ];
    }
}
