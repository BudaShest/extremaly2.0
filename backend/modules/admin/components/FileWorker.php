<?php
namespace app\modules\admin\components;

use app\modules\admin\models\Place;
use yii\base\BaseObject;
use yii\web\UploadedFile;
use app\modules\admin\models\interfaces\IFileWorkable;
use Yii;

class FileWorker extends BaseObject
{
    public $model;

    /** @var string|mixed  */
    public string $fileFolder = 'uploads'; //todo потом удалить

    //TODO в моделях попраить формирование пути убрать @webroot

    /**
     * @param $config
     */
    public function __construct($config = [])
    {
        if(in_array('model' , $config)){
            $this->model = $config['model'];
        }
        if(in_array('fileFolder' , $config)){
            $this->fileFolder = $config['fileFolder'];
        }
        parent::__construct($config);
    }

    /**
     * @param string $fileAttribute
     * @return bool
     */
    public function attachFiles(string $fileAttribute = 'uploads'): bool
    {
        if(!($this->model->$fileAttribute = UploadedFile::getInstances($this->model, $fileAttribute))){
            $this->model->addError($fileAttribute, 'Ошибка загрузки файла');
            return false;
        }
        return true;
    }

    /**
     * @param string $fileAttribute
     * @return bool
     */
    public function attachFile(string $fileAttribute = 'uploads'): bool
    {
        if(!($this->model->$fileAttribute = UploadedFile::getInstance($this->model, $fileAttribute))){
            $this->model->addError($fileAttribute, 'Ошибка загрузки файла');
            return false;
        }
        return true;
    }

    /**
     * @param string|null $fileFolder
     * @return bool
     */
    public function deleteFiles(string $fileFolder = null): bool
    {
        return $this->model->deleteFiles();
    }

    /**
     * @param string $fileField
     * @return bool
     */
    public function upload(): bool
    {
        return $this->model->upload();
    }
}