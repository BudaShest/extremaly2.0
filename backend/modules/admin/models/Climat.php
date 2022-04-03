<?php

namespace app\modules\admin\models;

use app\models\Climat as BaseClimat;
use app\modules\admin\behaviors\SingleFileBehavior;
use yii\web\UploadedFile;

class Climat extends BaseClimat
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors[] = [
            'class' => SingleFileBehavior::class,
            'model' => $this,
            'fileField' => 'icon'
        ];
        return $behaviors;
    }

    public $uploads;

    /** @var string  */
    public const MODEL_NAME_RU = 'Климат';
    /** @var string  */
    public const MODEL_NAME_RU_MULTI = 'Климаты';

    public const DEFAULT_IMAGE = 'https://cdn-icons.flaticon.com/png/512/2862/premium/2862807.png?token=exp=1649008804~hmac=eabe1a266da93f07a895719a3c15c439';

    public function rules(): array
    {
        $rules = parent::rules();
        $rules[] = [['uploads'], 'file', 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => 1024 * 1024];
        return $rules;
    }


    public function attributeLabels(): array
    {
        return [
            'code' => 'Код климата (HOT, COLD...)',
            'name' => 'Имя',
            'uploads' => 'Иконка'
        ];
    }
}