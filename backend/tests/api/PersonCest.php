<?php

use Codeception\Util\HttpCode;
use Faker\Factory;

class PersonCest
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
     * Cписок персон
     * @param ApiTester $I
     * @return void
     */
    public function indexTest(ApiTester $I): void
    {
        $I->amGoingTo('Получить список персон');
        $I->sendGet('/person');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expect('Увидеть список персон в формате JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Запись персоны
     * @param ApiTester $I
     * @return void
     */
    public function viewTest(ApiTester $I): void
    {
        $I->amGoingTo('Получить запись персоны');
        $I->sendGet('/person/view?id=1');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть запись персоны в формате JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Создать запись персоны
     * @param ApiTester $I
     * @return void
     */
    public function createTest(ApiTester $I): void
    {
        $I->amGoingTo('Создать запись персоны');
        $I->sendPost('person/create', [
            'firstname' => $this->faker->firstName,
            'lastname' => $this->faker->lastName,
            'age' => 30,
            'patronymic' => $this->faker->text(8),
            'description' => $this->faker->text(256),
            'role' => $this->faker->jobTitle
        ]);
        $I->seeResponseCodeIs(HttpCode::CREATED);

        $I->expectTo('Увидеть только что созданную запись персоны в формате JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Обновить запись персоны
     * @param ApiTester $I
     * @return void
     */
    public function updateTest(ApiTester $I): void
    {
        $I->amGoingTo('Обновить запись персоны');
        $I->sendPut('/person/update?id=1', ['firstname' => 'test']);
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expect('Увидеть только что обновлённую запись персоны в формате JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Удалить запись персоны
     * @param ApiTester $I
     * @return void
     */
    public function deleteTest(ApiTester $I): void
    {
        $I->amGoingTo('Удалить');
        $I->sendDelete('/person/delete?id=1');
        $I->seeResponseCodeIs(HttpCode::NO_CONTENT);
    }
}
