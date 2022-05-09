<?php

use Codeception\Util\HttpCode;
use Faker\Factory;

class ReviewCest
{
    /** @var \Faker\Generator $faker */
    protected Faker\Generator $faker;

    /**
     * Внедрение зависимости
     * @return void
     */
    public function _inject()
    {
        $this->faker = Factory::create('ru-RU');
    }

    /**
     * Список всех отзывов к проекту
     * @param ApiTester $I
     * @return void
     */
    public function indexTest(ApiTester $I): void
    {
        $I->amGoingTo('Получить список');
        $I->sendGet('/review');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть список отзывов к проекту в формате JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Просмотр одного отзыва к проекту
     * @param ApiTester $I
     * @return void
     */
    public function viewTest(ApiTester $I): void
    {
        $I->amGoingTo('Получить один отзыв к проекту');
        $I->sendGet('/review/view?id=1');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть один отзыв к проекту в формате JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Создание записи отзыва к проекту
     * @param ApiTester $I
     * @return void
     */
    public function createTest(ApiTester $I): void
    {
        $I->amGoingTo('Создать запись отзыва к проекту');
        $I->sendPost('/review/create', [
            'user_id' => 1,
            "text" => $this->faker->text(120),
            'rating' => 5
        ]);
        $I->seeResponseCodeIs(HttpCode::CREATED);

        $I->expectTo('Увидеть только что созданную запись к проекту в формате JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Обновление записи отзыва к проекту
     * @param ApiTester $I
     * @return void
     */
    public function updateTest(ApiTester $I): void
    {
        $I->amGoingTo('Обновить запись отзыва к проекту');
        $I->sendPut('/review/update?id=1', [
            'text' => 'test'
        ]);
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть только что обновлённую запись к проекту в формате JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Удаление записи отзыва к проекту
     * @param ApiTester $I
     * @return void
     */
    public function deleteTest(ApiTester $I): void
    {
        $I->amGoingTo('Удалить запись отзыва к проекту');
        $I->sendDelete('/review/delete?id=1');
        $I->seeResponseCodeIs(HttpCode::NO_CONTENT);
    }
}
