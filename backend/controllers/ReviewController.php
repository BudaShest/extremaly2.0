<?php

namespace app\controllers;

use app\models\Review;
use Yii;
use yii\data\Pagination;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\Cors;
use yii\rest\ActiveController;

class ReviewController extends ActiveController
{
    /** @inheritdoc */
    public $modelClass = 'app\models\Review';

    /** @inheritdoc */
    protected function verbs(): array
    {
        return [
            'index' => ['GET', 'HEAD'],
            'view' => ['GET', 'HEAD'],
            'create' => ['OPTIONS', 'POST', 'HEAD'],
            'update' => ['PUT', 'PATCH'],
            'delete' => ['DELETE'],
        ];
    }


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
        $behaviors['authenticator']['except'] = ['index', 'view', 'update', 'delete', 'get-reviews-with-pagination', 'get-num-of-pages'];

        return $behaviors;
    }

    /**
     * Получить отзывы о проекте с пагинацией
     * @return array
     */
    public function actionGetReviewsWithPagination(): array
    {
        $query = Review::find();

        $pagination = new Pagination([
            'totalCount' => $query->count(),
        ]);

        $models = $query->limit($pagination->limit)->offset($pagination->offset)->all();
        return $models;
    }

    /**
     * Получить количество страниц
     * @return int
     */
    public function actionGetNumOfPages(): int
    {
        $query = Review::find();

        $pagination = new Pagination([
            'totalCount' => $query->count(),
            'pageSize' => 3
        ]);

        return $pagination->pageCount;
    }
}
