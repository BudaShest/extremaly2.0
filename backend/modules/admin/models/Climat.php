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

    public const DEFAULT_IMAGE = 'https://cdn-icons-png.flaticon.com/512/1599/1599017.png';

    public function rules(): array
    {
        $rules = parent::rules();
        $rules[] = [['uploads'], 'file', 'extensions' => ['png', 'jpg', 'gif','jpeg'], 'maxSize' => 1024 * 1024];
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