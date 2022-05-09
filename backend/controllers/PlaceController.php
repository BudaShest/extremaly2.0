<?php

namespace app\controllers;

use yii\data\Pagination;
use yii\filters\Cors;
use yii\rest\ActiveController;
use app\models\Place;

class PlaceController extends ActiveController
{
    /** @inheritdoc */
    public $modelClass = "app\models\Place";

    /** @inheritdoc */
    public function behaviors(): array
    {
        $behaviors = parent::behaviors();

        $behaviors['corsFilter'] = [
            'class' => Cors::class
        ];

        return $behaviors;
    }

    /**
     * Получить места по стране нахождения
     * @param string $countryCode
     * @return array
     */
    public function actionGetByCountryCode(string $countryCode): array
    {
        if (!$models = Place::find()->where(['country_code' => $countryCode])->all()) {
            return [];
        }
        return $models;
    }

    /**
     * Получить места по климату
     * @param string $climatCode
     * @return array
     */
    public function actionGetByClimatCode(string $climatCode): array
    {
        if (!$models = Place::find()->where(['climat_code' => $climatCode])->all()) {
            return [];
        }
        return $models;
    }

    /**
     * Получить места (с пагинацией)
     * @return array
     */
    public function actionGetPlacesWithPagination(): array
    {
        $query = Place::find();

        $pagination = new Pagination([
            'totalCount' => $query->count(),
        ]);
        $models = $query->offset($pagination->offset)->limit($pagination->limit)->all();
        return $models;
    }

    /**
     * Получить кол-во страниц (для пагинации))
     * @return int
     */
    public function actionGetNumOfPaginatedPages(): int
    {
        $query = Place::find();

        $pagination = new Pagination([
            'totalCount' => $query->count(),
        ]);
        return $pagination->pageCount;
    }
}
