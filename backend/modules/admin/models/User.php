<?php

namespace app\modules\admin\models;

use app\models\User as BaseUser;
use app\modules\admin\models\interfaces\IFileWorkable;

class User extends BaseUser implements IFileWorkable
{
    //TODO вынести в поведения (работа с файлами чи как)
    public $uploads;

    public function attributeLabels()
    {
        return [
          'login' => 'Логин',
          'avatar' =>  'Аватар',
          'email' => 'Email',
          'phone' => 'Номер телефона'
        ];
    }

    /** @inheritDoc */
    public function rules(): array
    {
        $rules = parent::rules();
        $rules[] = [['uploads'], 'file', 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => 1024 * 1024 * 3,];
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
}