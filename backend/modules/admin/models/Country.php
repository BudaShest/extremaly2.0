<?php

namespace app\modules\admin\models;

use app\models\Country as BaseCountry;
use Yii;
use app\modules\admin\models\interfaces\IFileWorkable;

class Country extends BaseCountry implements IFileWorkable
{
    /** @var string  */
    public const MODEL_NAME_RU = 'Страна';
    /** @var string  */
    public const MODEL_NAME_RU_MULTI = 'Страны';

    //TODO вынести в поведения (работа с файлами чи как)
    public $uploads;

    /** @inheritDoc */
    public function rules(): array
    {
        $rules = parent::rules();
        $rules[] = [['uploads'], 'file', 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => 1024 * 1024,];
        return $rules;
    }

    public function upload(string $fileFolder = 'uploads'): bool
    {
        $newName = time().$this->uploads->name;
        if(!$this->uploads->saveAs($fileFolder . "/" .$newName)){
            return false;
        }
        $this->uploads = null;
        $this->flag = $newName;
        return true;
    }

    public function deleteFiles(string $fileFolder = 'uploads'): bool
    {
        try{
            if(!unlink($fileFolder.'/'.$this->flag)){
                $this->addError('uploads', 'Ошибка удаления файлов');
                return false;
            }
            return true;
        }catch (\Exception $e){
            $this->addError('uploads', $e);
            return false;
        }
    }

    /** @inheritDoc */
    public function attributeLabels()
    {
        return [
            'code' => 'Код страны (RU, EN, US...)',
            'name' => 'Название',
            'uploads' => 'Флаг',
        ];
    }


}