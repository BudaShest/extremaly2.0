<?php

namespace app\modules\admin\models;

use app\models\Country as BaseCountry;
use app\modules\admin\behaviors\SingleFileBehavior;
use yii\web\UploadedFile;

/** @inheritdoc */
class Country extends BaseCountry
{
    /** @inheritdoc */
    public function behaviors(): array
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

    /** @var UploadedFile $uploads - Загрузки */
    public UploadedFile $uploads;

    /** @inheritDoc */
    public function rules(): array
    {
        $rules = parent::rules();
        $rules[] = [['uploads'], 'file', 'extensions' => ['png', 'jpg', 'gif','jpeg'], 'maxSize' => 1024 * 1024 * 5,];
        return $rules;
    }

    /** @inheritDoc */
    public function attributeLabels(): array
    {
        return [
            'code' => 'Код страны (RU, EN, US...)',
            'name' => 'Название',
            'uploads' => 'Флаг',
            'flag' => 'Флаг'
        ];
    }
}
