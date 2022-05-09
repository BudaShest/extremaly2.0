<?php

namespace app\controllers;

use app\models\Event;
use yii\data\Pagination;
use yii\rest\ActiveController;
use yii\filters\Cors;
use app\models\Person;

class PersonController extends ActiveController
{
    /** @inheritdoc */
    public $modelClass = 'app\models\Person';

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
     * Поиск личностей
     * @param string $requestedString
     * @return array|\yii\db\ActiveRecord[]
     */
    public function actionFindPersons(string $requestedString): array
    {
        //todo расширить алгоритм поиска
        if ($models = Person::find()->where(['ilike', 'firstname', $requestedString])->all()) {
            return $models;
        }
        if ($models = Person::find()->where(['ilike', 'lastname', $requestedString])->all()) {
            return $models;
        }
        return [];
    }

    /**
     * Получить роли в события
     * @return array
     */
    public function actionGetProfessions(): array
    {
        return Person::find()->select('role')->column();
    }

    /**
     * Получить личности по ролям в событии
     * @param string $profession
     * @return array|\yii\db\ActiveRecord[]
     */
    public function actionGetPersonsByProfession(string $profession): array
    {
        if ($models = Person::find()->where(['ilike', 'role', $profession])->all()) {
            return $models;
        }
        return [];
    }

    /**
     * Получить личности по возрасту
     * @param int $age
     * @return array|\yii\db\ActiveRecord[]
     */
    public function actionGetPersonsByAge(int $age): array
    {
        if ($models = Person::find()->where(['=', 'age', $age])->all()) {
            return $models;
        }
        return [];
    }

    /**
     * Получить случайные личности
     * @return array
     */
    public function actionGetRandomPersons(): array
    {
        if (!$id = Person::find()->select('id')->orderBy(['id' => SORT_DESC])->limit(1)->scalar()) {
            return [];
        }
        $result = [];
        $ids = range(1, $id); //todo алгоритм можно сделать и получше
        for ($i = 0; $i <= 2; $i++) {
            $id = array_rand($ids);
            $key = array_search($id, $ids);
            if ($model = Person::findOne($id)) {
                $result[] = $model;
            }
        }
        return $result;
    }

    /**
     * Получить первые 3 персоны
     * @return array|\yii\db\ActiveRecord[]
     */
    public function actionGetTopPersons(): array
    {
        if ($models = Person::find()->limit(3)->all()) {
            return $models;
        }
        return [];
    }

    /**
     * Получить личности по участию в событии
     * @param int $eventId
     * @return array|mixed
     */
    public function actionGetPersonsByEvent(int $eventId): array
    {
        if ($models = Event::findOne($eventId)->persons) {
            return $models;
        }
        return [];
    }

    /**
     * Получить количество страниц
     * @return int
     */
    public function actionGetNumOfPaginatedPages(): int
    {
        $query = Person::find();

        $pagination = new Pagination([
            'totalCount' => $query->count(),
        ]);
        return $pagination->pageCount;
    }

    /**
     * Получить личности (с пагинацией)
     * @return array
     */
    public function actionGetPersonsWithPagination(): array
    {
        $query = Person::find();

        $pagination = new Pagination([
            'totalCount' => $query->count(),
        ]);
        $models = $query->offset($pagination->offset)->limit($pagination->limit)->all();
        return $models;
    }
}
