<?php

namespace app\modules\admin\models;

use app\models\User as BaseUser;
use app\modules\admin\behaviors\SingleFileBehavior;
use app\modules\admin\models\interfaces\IFileWorkable;
use yii\web\UploadedFile;

final class User extends BaseUser
{
    /** @inheritdoc */
    public function behaviors(): array
    {
        $behaviors = parent::behaviors();
        $behaviors[] = [
            'class' => SingleFileBehavior::class,
            'model' => $this,
            'fileField' => 'icon'
        ];
        return $behaviors;
    }

    /** @var ?UploadedFile $uploads - загрузки */
    public ?UploadedFile $uploads = null;

    /** @inheritdoc */
    public function attributeLabels(): array
    {
        return [
            'login' => 'Логин',
            'avatar' => 'Аватар',
            'password' => 'Пароль',
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
