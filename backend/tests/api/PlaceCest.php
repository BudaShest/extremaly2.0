<?php

use Codeception\Util\HttpCode;
use Faker\Factory;

class PlaceCest
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
     * Список записей мест
     * @param ApiTester $I
     * @return void
     */
    public function indexTest(ApiTester $I): void
    {
        $I->amGoingTo('Получить список записей мест');
        $I->sendGet('/place');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть список записей мест в формате JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Запись места
     * @param ApiTester $I
     * @return void
     */
    public function viewTest(ApiTester $I): void
    {
        $I->amGoingTo('Получить запись места');
        $I->sendGet('/place/view?id=1');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть запись места в формате JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Создание записи места
     * @param ApiTester $I
     * @return void
     */
    public function createTest(ApiTester $I): void
    {
        $I->amGoingTo('Создать запись места');
        $I->sendPost('/place/create', [
            'name' => $this->faker->name(14),
            'address' => $this->faker->address,
            'description' => $this->faker->text(222),
            'country_code' => "RU",
            'climat_code' => "HOT"
        ]);
        $I->seeResponseCodeIs(HttpCode::CREATED);

        $I->expectTo('Увидеть только что созданную запись места в формате JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Обновление записи места
     * @param ApiTester $I
     * @return void
     */
    public function updateTest(ApiTester $I): void
    {
        $I->amGoingTo('Обновить запись места');
        $I->sendPut('/place/update?id=1', ['name' => 'test']);
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть только что обновлённую запись места в формате JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Удаление записи места
     * @param ApiTester $I
     * @return void
     */
    public function deleteTest(ApiTester $I): void
    {
        $I->amGoingTo('Удалить');
        $I->sendDelete('/place/delete?id=1');
        $I->seeResponseCodeIs(HttpCode::NO_CONTENT);
    }

    /**
     * Получить места по стране проведения
     * @param ApiTester $I
     * @return void
     */
    public function getByCountryCode(ApiTester $I): void
    {
        $I->amGoingTo('Получить места по стране проведения');
        $I->sendGet('/place/get-by-country-code?countryCode=US');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть место по стране проведения JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Получить места по климату
     * @param ApiTester $I
     * @return void
     */
    public function getByClimmatCode(ApiTester $I): void
    {
        $I->amGoingTo('Получить места по климату');
        $I->sendGet('/place/get-by-climat-code?climatCode=HOT');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть место по климату в формате JSON');
        $I->seeResponseIsJson();
    }
}
