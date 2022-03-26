<?php

namespace app\modules\admin\models;

use app\models\Place as BasePlace;
use app\models\PlaceImage;
use Yii;
use app\modules\admin\models\interfaces\IFileWorkable;

class Place extends BasePlace implements IFileWorkable
{
    //todo сделать также в других модельках модуля
    /** @var string  */
    public const MODEL_NAME_RU = 'Место';
    /** @var string  */
    public const MODEL_NAME_RU_MULTI = 'Места';

    public $uploads;

    /** @inheritDoc */
    public function rules(): array
    {
        $rules = parent::rules();
        $rules[] = [['uploads'], 'file', 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => 1024 * 1024 * 10];
        return $rules;
    }

    /** @inheritDoc */
    public function attributeLabels(): array
    {
        return [
            'name' => 'Имя',
            'address' => 'Адрес',
            'description' => 'Описание',
            'climat_code' => 'Климат',
            'country_code' => 'Страна',
            'uploads' => 'Файлы изображений'
        ];
    }

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
            $placeImage = new PlaceImage(['image'=>$newName]);
            $this->link('images', $placeImage);
        }
        return true;
    }
}