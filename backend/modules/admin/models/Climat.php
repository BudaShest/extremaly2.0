<?php

namespace app\modules\admin\models;

use app\models\Climat as BaseClimat;
use yii\web\UploadedFile;
use Yii;
use app\modules\admin\models\interfaces\IFileWorkable;

class Climat extends BaseClimat implements IFileWorkable
{
    /** @var string  */
    public const MODEL_NAME_RU = 'Климат';
    /** @var string  */
    public const MODEL_NAME_RU_MULTI = 'Климаты';

    //TODO вынести в поведения (работа с файлами)
    public $uploads;

    public function rules(): array
    {
        $rules = parent::rules();
        $rules[] = [['uploads'], 'file', 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => 1024 * 1024];
        return $rules;
    }

    public function upload(string $fileFolder = 'uploads'): bool
    {
        $newName = time().$this->uploads->name;
        if(!$this->uploads->saveAs($fileFolder . "/" .$newName)){
            return false;
        }
        $this->uploads = null;
        $this->icon = $newName;
        return true;
    }

    public function deleteFiles(string $fileFolder = 'uploads'): bool
    {
        return unlink($fileFolder.'/'.$this->icon);
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