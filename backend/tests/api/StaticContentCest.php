<?php

use Codeception\Util\HttpCode;
use Faker\Factory;

class StaticContentCest
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
     * Список статичного контента
     * @param ApiTester $I
     * @return void
     */
    public function indexTest(ApiTester $I): void
    {
        $I->amGoingTo('Получить список статичного контента');
        $I->sendGet('/static-content/');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть список статичного контента в формате JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Запись статичного контента
     * @param ApiTester $I
     * @return void
     */
    public function viewTest(ApiTester $I): void
    {
        $I->amGoingTo('Получить запись статичного контента');
        $I->sendGet('/static-content/view?id=1');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть запись статичного контента в формате JSONe');
        $I->seeResponseIsJson();
    }

    /**
     * Создание записи статичного контента
     * @param ApiTester $I
     * @return void
     */
    public function createTest(ApiTester $I): void
    {
        $I->amGoingTo('Создать запись статичного контента');
        $I->sendPost('/static-content/create', [
            'title' => $this->faker->text(30),
            'image' => "test.jpg",
            'text' => $this->faker->text(240)
        ]);
        $I->seeResponseCodeIs(HttpCode::CREATED);

        $I->expectTo('Увидеть только что созданную запись статичного контента');
        $I->seeResponseIsJson();
    }

    /**
     * Обновление записи статичного контента
     * @param ApiTester $I
     * @return void
     */
    public function updateTest(ApiTester $I): void
    {
        $I->amGoingTo('Обновить запись статичного контента');
        $I->sendPut('/static-content/update?id=1', ['title' => 'test']);
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть только что обновлённую запись статичного контента');
        $I->seeResponseIsJson();
    }

    /**
     * Удаление записи статичного контента
     * @param ApiTester $I
     * @return void
     */
    public function deleteTest(ApiTester $I): void
    {
        $I->amGoingTo('Удалить запись статичного контента');
        $I->sendDelete('/static-content/delete?id=1');
        $I->seeResponseCodeIs(HttpCode::NO_CONTENT);
    }
}
