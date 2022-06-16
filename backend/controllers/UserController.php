<?php

namespace app\controllers;

use Prophecy\Exception\Doubler\MethodNotFoundException;
use yii\db\Exception;
use yii\filters\Cors;
use yii\rest\ActiveController;
use app\models\User;
use app\models\Banned;
use Codeception\Util\HttpCode;
use Yii;
use yii\filters\auth\HttpBearerAuth;
use yii\web\BadRequestHttpException;
use yii\web\IdentityInterface;
use yii\web\MethodNotAllowedHttpException;
use yii\web\NotFoundHttpException;


class UserController extends ActiveController
{
    /** @inheritdoc */
    public $modelClass = 'app\models\User';

    /** @inheritdoc */
    public function behaviors(): array
    {
        $behaviors = parent::behaviors();

        $behaviors['corsFilter'] = [
            'class' => Cors::class,
        ];

//        $behaviors['authenticator'] = [
//            'class' => HttpBearerAuth::class,
//        ];
//        $behaviors['authenticator']['except'] = ['register', 'login'];

        return $behaviors;
    }

    /** @inheritdoc */
    protected function verbs(): array
    {
        return [
            'index' => ['GET', 'HEAD'],
            'view' => ['OPTIONS', 'GET', 'HEAD'],
            'create' => ['OPTIONS', 'POST'],
            'update' => ['OPTIONS', 'PUT', 'PATCH'],
            'delete' => ['DELETE'],
        ];
    }

    /**
     * Регистрация пользователя
     * @return array
     * @throws BadRequestHttpException|\yii\base\Exception
     */
    public function actionRegister(): array
    {
        $model = new User();
        if ($request = Yii::$app->request->post()) {
            if (!$model->register($request)) {
                return $model->errors;
            }
            return ["result" => true, "message" => $model->login . ' был успешно зарегистрирован', 'status' => HttpCode::OK];
        }
        throw new BadRequestHttpException('Неверный запрос');
    }

    /**
     * Авторизация пользователя
     * @return array
     * @throws BadRequestHttpException
     */
    public function actionLogin(): array
    {
        if ($request = Yii::$app->request->post()) {
            $model = User::findOne(['login' => Yii::$app->request->post('login')]);

            try {
                if (!$model->login($request)) {
                    return $model->errors;
                } else {
                    Yii::$app->user->login($model);
                    return ["message" => 'Пользователь был успешно авторизован', "status" => HttpCode::OK, "login" => $model->login, "id" => $model->id, "token" => $model->access_token, 'isAuth' => true];
                }
            } catch (\Exception $e) {
                return ['message' => $e->getMessage(), "status" => HttpCode::UNAUTHORIZED];
            }
        }
        throw new BadRequestHttpException();
    }

    /**
     * @return IdentityInterface
     * @deprecated
     */
    public function actionCheck(): IdentityInterface
    {
        return Yii::$app->user->identity;
    }

    /**
     * Обновление пользовательский информации
     * @param int $id
     * @return array|string[]
     * @throws MethodNotAllowedHttpException
     * @throws \yii\base\Exception
     */
    public function actionUpdateUser(int $id): array //todo разделить этот метод
    {
        if ($request = Yii::$app->request->post()) {
            $user = User::findOne($id);
            if ($request['login']) {
                $user->login = $request['login'];
            }
            if ($request['password']) {
                $user->password = Yii::$app->security->generatePasswordHash($request['password']);

            }
            if ($request['phone']) {
                $user->phone = $request['phone'];
            }
            if ($request['email']) {
                $user->email = $request['email'];
            }
            $user->confirmPassword = $user->password; //todo пока заглушка
            if (!$user->save()) {
                return $user->errors;
//                return ['message' => 'Ошибка обновления пользовательской информации'];
            }
            return ['message' => 'Пользователь был успешно обновлён!'];
        }
        throw new MethodNotAllowedHttpException('Только POST');
    }

    /**
     * Обновить аватар
     * @return array
     * @throws MethodNotAllowedHttpException
     */
    public function actionUpdateAvatar(): array
    {
        if ($request = Yii::$app->request->post()) {
            try {
                if ($file = $_FILES['avatar']) {
                    if (move_uploaded_file($file['tmp_name'], 'uploads/' . $file['name'])) {
                        $newName = 'http://' . Yii::$app->request->hostName . ':' . Yii::$app->request->port . '/uploads/' . $file['name'];
                        $user = User::findOne($request['user_id']);
                        $user->avatar = $newName;
                        if (!$user->save()) {
                            return ["message" => 'Ошибка обновления автара!', "status" => HttpCode::NOT_MODIFIED, "error" => $user->errors];
                        }
                        return ["message" => 'Аватар был успешно обновлён', "status" => HttpCode::OK];
                    }
                }
            } catch (\Exception $e) {
                return ["message" => $e->getMessage(), "status" => HttpCode::INTERNAL_SERVER_ERROR];
            }
        }
        throw new MethodNotAllowedHttpException();
    }

    /**
     * Выход из учётки
     * @return array
     * @throws MethodNotAllowedHttpException
     */
    public function actionLogout(): array
    {
        if (Yii::$app->request->isPost) {
            $result = Yii::$app->user->logout();
            return ['status' => HttpCode::OK, "result" => $result, 'message' => 'До свидания =('];
        }
        throw new MethodNotAllowedHttpException();
    }
}
