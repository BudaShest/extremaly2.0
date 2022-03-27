<?php

namespace app\modules\admin\models;

use app\models\EventType as BaseEventType;
use app\modules\admin\models\interfaces\IFileWorkable;

class EventType extends BaseEventType implements IFileWorkable
{
    public $uploads;

    public function rules(): array
    {
        $rules = parent::rules();
        $rules[] = [['uploads'], 'file', 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => 1024 * 1024]; //todo возможно создать встроенный валидатор или как то вынести код
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

    public function attributeLabels(): array
    {
        return [
            'name' => 'Имя',
            'uploads' => 'Иконка'
        ];
    }
}