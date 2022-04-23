<?php

namespace app\modules\admin\controllers;

use app\modules\admin\components\ErrorHelper;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use app\modules\admin\models\Ticket;

use Yii;

class TicketController extends Controller
{
    /**
     * @return array[]
     */
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'create', 'delete', 'view'],
                        'roles' => ['@'],
                    ],
                ],
                'denyCallback' => function(){
                    return $this->redirect('main/login');
                },
            ]
        ];
    }

    /**
     * Страница со списком всех видов билетов
     * @return string
     */
    public function actionIndex(): string
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Ticket::find(),
            'pagination' => [
                'pageSize' => 10
            ]
        ]);

        return $this->render('index', compact('dataProvider'));
    }

    /**
     * Страница добавления типов билетов
     * @return string|Response
     */
    public function actionCreate()
    {
        $model = new Ticket();
        if($model->load(Yii::$app->request->post())){
            if(!$model->save()){
                Yii::$app->session->setFlash('error', ErrorHelper::format($model->errors));
                return $this->redirect(Yii::$app->request->referrer);
            }
            return $this->redirect('/admin/ticket');
        }
        return $this->render('create',compact('model'));
    }
}
