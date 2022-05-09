<?php

use Codeception\Util\HttpCode;
use Faker\Factory;

class CountryCest
{
    /** @var \Faker\Generator $faker */
    private $faker;

    /**
     * Внедрение зависимости
     */
    public function _inject()
    {
        $this->faker = Factory::create('ru');
    }

    public function _before(ApiTester $I)
    {
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

//    /**
//     * Обновление страны
//     * @param ApiTester $I
//     * @return void
//     */
//    public function updateTest(ApiTester $I): void
//    {
//        $I->amGoingTo('Обновить страну');
//        $I->sendPost('/country/update?id=TE', ['name' => 'Тест']);
//        $I->seeResponseCodeIs(HttpCode::OK);
//
//        $I->expectTo('Название страны будет обновлено');
//        //todo grabнуть респонс
//    }
//

    /**
     * Удаление страны
     * @param ApiTester $I
     * @return void
     */
    public function deleteTest(ApiTester $I): void //todo не работает
    {
        $I->amGoingTo('Удалить страну');
        $I->sendDelete('/country/delete?id=TE');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Запись страны будет удалена');
        $I->seeResponseIsJson();
    }
}
