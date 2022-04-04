<?php

namespace app\modules\admin\behaviors;

use Yii;

use yii\base\Behavior;
use yii\web\UploadedFile;

class SingleFileBehavior extends Behavior
{
    public $fileUrl;
    public $fileFolder = 'uploads';
    public $fileField;
    public $model;

    public function init()
    {
        $this->fileUrl = 'http://' . Yii::$app->request->hostName . ':' . Yii::$app->request->port . '/uploads/';
        parent::init();
    }

    public function upload(): bool
    {
        $fileField = $this->fileField;
        $newName = time().$this->model->uploads->name;
        if(!$this->model->uploads->saveAs("{$this->fileFolder}/" .$newName)){
            return false;
        }
        $this->model->uploads = null;
        $this->model->$fileField = $this->fileUrl . $newName;
        return true;
    }

    public function deleteFiles(): bool
    {
        $fileField = $this->fileField;
        $class = $this->model->className();
        $oldImage = $this->model->$fileField;
        $this->model->$fileField = $class::DEFAULT_IMAGE;
        $this->model->save();
//        var_dump($oldImage);
        $oldImage = explode('/', $oldImage);
        $oldImage = $oldImage[count($oldImage)- 2] . '/' . $oldImage[count($oldImage)- 1];
//        var_dump($oldImage);die;
        try{
            if(!unlink($oldImage)){
                return false;
            }
            return true;
        }catch (\Exception $e){
//            var_dump($e->getMessage());die;
            $this->model->addError('uploads', $e);
            return false;
        }
    }
}