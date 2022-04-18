<?php

namespace app\modules\admin\models;

use app\models\User as BaseUser;
use app\modules\admin\behaviors\SingleFileBehavior;
use app\modules\admin\models\interfaces\IFileWorkable;

class User extends BaseUser
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors[] = [
            'class' => SingleFileBehavior::class,
            'model' => $this,
            'fileField' => 'icon'
        ];
        return $behaviors;
    }

    //TODO вынести в поведения (работа с файлами чи как)
    public $uploads;

    public function attributeLabels()
    {
        return [
            'login' => 'Логин',
            'avatar' => 'Аватар',
            'email' => 'Email',
            'phone' => 'Номер телефона',
            'role_id' => 'Роль',
            'ip' => 'IP-адрес',
        ];
    }

    /** @inheritDoc */
    public function rules(): array
    {
        $rules = parent::rules();
        $rules[] = [['uploads'], 'file', 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => 1024 * 1024 * 3,];
        return $rules;
    }
}
