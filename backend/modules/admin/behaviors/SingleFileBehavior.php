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
        $this->model->$fileField = $class::DEFAULT_IMAGE;
        $this->model->save();
        try{
            if(!unlink($this->fileFolder.'/'.$this->model->$fileField)){
                return false;
            }
            return true;
        }catch (\Exception $e){
            $this->model->addError('uploads', $e);
            return false;
        }
    }
}