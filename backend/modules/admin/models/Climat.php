<?php

namespace app\modules\admin\models;

use app\models\Climat as BaseClimat;

class Climat extends BaseClimat
{
    //TODO вынести в поведения (работа с файлами)
    public $uploads;

    public function rules(): array
    {
        $rules = parent::rules(); // TODO: Change the autogenerated stub
        $rules[] = [['uploads'], 'file', 'extensions'=>['png', 'jpg', 'gif'], 'maxSize' => 1024*1024];
        return $rules;
    }

    public function attributeLabels()
    {
        return [
            'code' => 'Код климата (HOT, COLD...)',
            'name' => 'Имя',
            'uploads' => 'Иконка'
        ];
    }
}