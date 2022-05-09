<?php

use Codeception\Util\HttpCode;
use Faker\Factory;

class PersonCest
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
     * Список персон
     * @param ApiTester $I
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
     */
    public function deleteTest(ApiTester $I): void
    {
        $I->amGoingTo('Удалить');
        $I->sendDelete('/person/delete?id=1');
        $I->seeResponseCodeIs(HttpCode::NO_CONTENT);
    }

    /**
     * Поиск личностей
     * @param ApiTester $I
     */
    public function findPersonsTest(ApiTester $I): void
    {
        $I->amGoingTo('Найти личности по имени или фамилии');
        $I->sendGet('/person/find-persons?requestedString=' . urlencode('Аркадий'));
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть найденные личности в формате JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Получить все роли в событии (ранее - профессии)
     * @param ApiTester $I
     */
    public function getProfessionsTest(ApiTester $I): void
    {
        $I->amGoingTo('Получить все роли в событии');
        $I->sendGet('/person/get-professions');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть все роли в событии в формате JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Получить личности по роли в событии
     * @param ApiTester $I
     */
    public function getPersonsByProfessionTest(ApiTester $I): void
    {
        $I->amGoingTo('Получить личности по роли в событии');
        $I->sendGet('/person/get-persons-by-profession?profession=' . urlencode('организатор'));
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Получить личности по роли в событии');
        $I->seeResponseIsJson();
    }

    /**
     * Получить личности по возрасту
     * @param ApiTester $I
     */
    public function getPersonsByAgeTest(ApiTester $I): void
    {
        $I->amGoingTo('Получить личности по возрасту');
        $I->sendGet('/person/get-persons-by-age?age=18');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Получить личности по возрасту в формате JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Получить случайные личности
     * @param ApiTester $I
     */
    public function getRandomPersonsTest(ApiTester $I): void
    {
        $I->amGoingTo('Получить случайные личности');
        $I->sendGet('/person/get-random-persons');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Получить случайные личности в формате JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Получить первые 3 персоны
     * @param ApiTester $I
     */
    public function getTopPersonsTest(ApiTester $I): void
    {
        $I->amGoingTo('Получить первые 3 персоны');
        $I->sendGet('/person/get-top-persons');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Получить первые 3 персоны в формате JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Получить личности по участию в событии
     * @param ApiTester $I
     */
    public function getPersonsByEventTest(ApiTester $I): void
    {
        $I->amGoingTo('Получить личности по участию в событии');
        $I->sendGet('/person/get-persons-by-event?eventId=1');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть личности по участию событию в формате JSON');
        $I->seeResponseIsJson();
    }
}
