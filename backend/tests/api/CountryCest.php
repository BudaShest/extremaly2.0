<?php

use Codeception\Util\HttpCode;
use Faker\Factory;

class CountryCest
{
    /** @var \Faker\Generator $faker */
    protected Faker\Generator $faker;

    /**
     * Внедрение зависимости
     */
    public function _inject()
    {
        $this->faker = Factory::create('ru');
    }

    /**
     * Список стран
     * @param ApiTester $I
     * @return void
     */
    public function indexTest(ApiTester $I): void
    {
        $I->amGoingTo('Получить список стран');
        $I->sendGet('/country');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Получить список стран в формате JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Получить страну
     * @param ApiTester $I
     * @return void
     */
    public function viewTest(ApiTester $I):void
    {
        $I->amGoingTo('Получить определённую страну');
        $I->sendGet('/country/view?id=RU');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Получить страну в формате JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Создать страну
     * @param ApiTester $I
     * @return void
     */
    public function createTest(ApiTester $I): void
    {
        $I->amGoingTo('Создать страну');
        $I->sendPost('/country/create', ['code' => 'TE', 'name' => $this->faker->country, 'flag' => 'test']);
        $I->seeResponseCodeIs(HttpCode::CREATED);

        $I->expectTo('Создать страну и получить ');
        $I->seeResponseIsJson();
    }

    /**
     * Обновление страны
     * @param ApiTester $I
     * @return void
     */
    public function updateTest(ApiTester $I): void
    {
        $I->amGoingTo('Обновить страну');
        $I->sendPut('/country/update?id=RU', ['name' => 'Тест']);
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Название страны будет обновлено');
        $I->seeResponseIsJson();
    }


    /**
     * Удаление страны
     * @param ApiTester $I
     * @return void
     */
    public function deleteTest(ApiTester $I): void
    {
        $I->amGoingTo('Удалить страну');
        $I->sendDelete('/country/delete?id=RU');
        $I->seeResponseCodeIs(HttpCode::NO_CONTENT);
    }
}
