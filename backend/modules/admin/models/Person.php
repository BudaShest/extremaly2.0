<?php

namespace app\modules\admin\models;

use app\models\Person as BasePerson;
use app\models\PersonImage;
use app\modules\admin\models\interfaces\IFileWorkable;

class Person extends BasePerson implements IFileWorkable
{
    /** @inheritDoc */
    public function rules(): array
    {
        $rules = parent::rules();
        $rules[] = [['uploads'], 'file', 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => 1024 * 1024 * 10];
        return $rules;
    }

    public $uploads;

    public function attributeLabels(): array
    {
        return [
          'firstname' => 'Имя',
          'lastname' => 'Фамилия',
          'patronymic' => 'Отчество',
          'age' => 'Возраст',
          'description' => 'Описание',
          'profession' => 'Профессия'
        ];
    }

    //TODO imageBehaivour для всех сущеностей с таблицами image
    public function deleteFiles(string $fileFolder = 'uploads'): bool
    {
        foreach($this->images as $image){
            if(!unlink($fileFolder.'/'.$image['image'])){
                return false;
            }
        }
        return true;
    }

    public function upload(string $fileFolder = 'uploads'): bool
    {
        foreach($this->uploads as $upload){
            $newName = time().$upload->name;
            if(!$upload->saveAs($fileFolder . "/" .$newName)){
                return false;
            }
            $personImage = new PersonImage(['image'=>$newName]);
            $this->link('images', $personImage);
        }
        return true;
    }
}