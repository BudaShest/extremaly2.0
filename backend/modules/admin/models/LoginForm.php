<?php

namespace app\modules\admin\models;

use app\models\Role;
use yii\base\Model;
use app\models\User;
use Yii;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;

/**
 * Модель "Форма авторизации"
 */
final class LoginForm extends Model
{
    /** @var string - Логин */
    public string $login = '';
    /** @var string - Пароль */
    public string $password = '';

    /** @inheritDoc */
    public function attributeLabels(): array
    {
        return [
            'login' => 'Логин',
            'password' => 'Пароль',
        ];
    }

    /** @inheritDoc */
    public function rules(): array
    {
        return [
            [['login', 'password'], 'required'],
        ];
    }

    /**
     * Авторизация
     * @param array $request
     * @return bool
     * @throws BadRequestHttpException
     */
    public function login(array $request): bool
    {
        if ($request = $request['LoginForm']) {
            if (!$model = User::findOne(['login' => $request['login']])) {
                $this->addError('login', 'Пользователь с таким логином отсутствует!');
                return false;
            }
            if (!Yii::$app->security->validatePassword($request['password'], $model->password)) {
                $this->addError('password', 'Неправильный пароль');
                return false;
            }
            if ($model->role_id != Role::ADMIN_ROLE_ID) {
                $this->addError('role_id', 'Недостаточно прав!');
                return false;
            }
            if (!Yii::$app->user->login($model)) {
                Yii::$app->session->setFlash('error', 'Не удалось авторизоваться');
                return false;
            }
            return true;
        }
        throw new BadRequestHttpException('Неправильный запрос!');
    }

}
