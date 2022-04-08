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
use yii\web\MethodNotAllowedHttpException;
use yii\web\NotFoundHttpException;


class UserController extends ActiveController
{
    public $modelClass = 'app\models\User';

    public function behaviors(): array
    {
        $behaviors = parent::behaviors();

        $behaviors['corsFilter'] = [
            'class' => Cors::class,
//            'cors' => [
//                 restrict access to
//                'Access-Control-Allow-Origin' => ['http://localhost:3000'],
//                 Allow only POST and PUT methods
//                'Access-Control-Request-Method' => ['POST', 'GET', 'OPTIONS'],
//                 Allow only headers 'X-Wsse'
//                'Access-Control-Request-Headers' => ['X-Wsse'],
//                 Allow credentials (cookies, authorization headers, etc.) to be exposed to the browser
//                'Access-Control-Allow-Credentials' => true,
//                 Allow OPTIONS caching
//                'Access-Control-Max-Age' => 3600,
//                 Allow the X-Pagination-Current-Page header to be exposed to the browser.
//                'Access-Control-Expose-Headers' => ['X-Pagination-Current-Page'],
//            ]
        ];
//        $behaviors['authenticator'] = [
//            'class' => HttpBearerAuth::class,
//        ];
//
//        $behaviors['authenticator']['except'] = ['register', 'login'];

        return $behaviors;
    }

    protected function verbs()
    {
        return [
            'index' => ['GET', 'HEAD'],
            'view' => ['GET', 'HEAD'],
            'create' => ['OPTIONS', 'POST'],
            'update' => ['OPTIONS', 'PUT', 'PATCH'],
            'delete' => ['DELETE'],
        ];
    }


    public function actionRegister()
    {
        $model = new User();
        if ($request = Yii::$app->request->post()) {
            if (!$model->register($request)) {
                return $model->errors;
            }
            return ["message" => $model->login . ' был успешно зарегистрирован', 'status'=>HttpCode::OK];
        }
        throw new BadRequestHttpException('Неверный запрос');
    }

    public function actionLogin()
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

    public function actionCheck()
    {
        return Yii::$app->user->identity;
    }

    public function actionUpdateUser(int $id)
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

    public function actionUpdateAvatar()
    {
        if($request = Yii::$app->request->post()){
            try {
                if ($file = $_FILES['avatar']) {
                    if (move_uploaded_file($file['tmp_name'], 'uploads/' . $file['name'])) {
                        $newName = 'http://' . Yii::$app->request->hostName . ':' . Yii::$app->request->port . '/uploads/' . $file['name'];
                        $user = User::findOne($request['user_id']);
                        $user->avatar = $newName;
                        if(!$user->save()){
                            return ["message" => 'Ошибка обновления автара!', "status"=>HttpCode::NOT_MODIFIED, "error"=>$user->errors];
                        }
                        return ["message" => 'Аватар был успешно обновлён', "status"=>HttpCode::OK];
                    }
                }
            } catch (\Exception $e) {
                return ["message" => $e->getMessage(), "status"=>HttpCode::INTERNAL_SERVER_ERROR ];
            }
        }
        throw new MethodNotAllowedHttpException();
    }

    public function actionLogout()
    {
        if (Yii::$app->request->isPost) {
            $result = Yii::$app->user->logout();
            return ['status' => HttpCode::OK, "result" => $result, 'message' => 'До свидания =('];
        }
        throw new MethodNotAllowedHttpException();
    }

}