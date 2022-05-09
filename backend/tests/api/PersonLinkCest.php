<?php

use Codeception\Util\HttpCode;
use Faker\Factory;

class PersonLinkCest
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
     * Список соц. сетей персон
     * @param ApiTester $I
     * @return void
     */
    public function indexTest(ApiTester $I): void
    {
        $I->amGoingTo('Получить список соц. сетей персон');
        $I->sendGet('/person-link');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expect('Увидеть список соц. сетей персон в формате JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Просмотр соц. сети персоны
     * @param ApiTester $I
     * @return void
     */
    public function viewTest(ApiTester $I): void
    {
        $I->amGoingTo('Получить соц. сети персоны');
        $I->sendGet('/person-link/view?id=1');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть соц. сеть персоны в формате JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Создать запись соц. сети персоны
     * @param ApiTester $I
     * @return void
     */
    public function createTest(ApiTester $I): void
    {
        $I->amGoingTo('Создать запись соц. сети персоны');
        $I->sendPost('/person-link/create', [
            'person_id' => 1,
            'title' => $this->faker->text(12),
            'icon' => 'test.img',
            'url' => $this->faker->url
        ]);
        $I->seeResponseCodeIs(HttpCode::CREATED);

        $I->expectTo('Получить только что созданную запись соц. сети персоны в формате JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Обновление записи соц. сети персоны
     * @param ApiTester $I
     * @return void
     */
    public function updateTest(ApiTester $I): void
    {
        $I->amGoingTo('Обновить запись соц. сети персоны');
        $I->sendPut('/person-link/update?id=1', ['title' => 'test']);
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expect('Увидеть только что созданную запись соц. сети персоны');
        $I->seeResponseIsJson();
    }

    /**
     * Удалить запись соц. сети персоны
     * @param ApiTester $I
     * @return void
     */
    public function deleteTest(ApiTester $I): void
    {
        $I->amGoingTo('Удалить запись соц. сети персоныы');
        $I->sendDelete('/person-link/delete?id=1');
        $I->seeResponseCodeIs(HttpCode::NO_CONTENT);
    }
}
