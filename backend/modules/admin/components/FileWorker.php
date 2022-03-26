<?php
namespace app\modules\admin\components;

use app\modules\admin\models\Place;
use yii\base\BaseObject;
use yii\web\UploadedFile;
use app\modules\admin\models\interfaces\IFileWorkable;

class FileWorker extends BaseObject implements IFileWorkable
{
    /** @var IFileWorkable|mixed  */
    public IFileWorkable $model;

    /** @var string|mixed  */
    public string $fileFolder = 'uploads';

    //TODO в моделях попраить формирование пути убрать @webroot

    /**
     * @param $config
     */
    public function __construct($config = []) //todo итерфейс (работает с файлами что)
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
        return $this->model->deleteFiles($fileFolder ?? $this->fileFolder);
    }

    /**
     * @param string|null $fileFolder
     * @return bool
     */
    public function upload(string $fileFolder = null): bool
    {
        return $this->model->upload($fileFolder ?? $this->fileFolder);
    }
}