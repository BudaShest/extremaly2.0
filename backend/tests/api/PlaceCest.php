<?php

use Codeception\Util\HttpCode;
use Faker\Factory;

class PlaceCest
{
    /** @var \Faker\Generator $faker */
    protected $faker;

    public function _before(ApiTester $I)
    {
    }

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

        $I->expect('Увидеть список записей мест в формате JSON');
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

        $I->expect('Увидеть только что обновлённую запись места в формате JSON');
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
}
