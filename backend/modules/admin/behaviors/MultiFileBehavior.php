<?php
namespace app\modules\admin\behaviors;

use yii\base\Behavior;
use Yii;

class MultiFileBehavior extends Behavior
{
    public $fileUrl;
    public $fileFolder = 'uploads';
    public $fileField;
    public $model;
    public $imageClass; //todo возможно ко всем image классам прциепить интерфейс

    public function init()
    {
        $this->fileUrl = 'http://' . Yii::$app->request->hostName . ':' . Yii::$app->request->port . '/uploads/';
        parent::init();
    }

    public function deleteFiles(): bool
    {
        try{
            foreach($this->model->images as $image){
                if(!unlink($this->fileFolder.'/'.$image['image'])){
                    return false;
                }
            }
            return true;
        }catch (\Exception $e){
            $this->model->addError('uploads', $e);
            return false;
        }
    }

    public function upload(): bool
    {
        foreach($this->model->uploads as $upload){
            $newName = time().$upload->name;
            if(!$upload->saveAs("uploads/" .$newName)){
                return false;
            }
            $modelImage = new $this->imageClass(['image'=>$this->fileUrl . $newName]);
            $this->model->link('images', $modelImage);
        }
        return true;
    }
}