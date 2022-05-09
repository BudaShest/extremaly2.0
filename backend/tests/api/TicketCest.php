<?php

use Codeception\Util\HttpCode;
use Faker\Factory;

class TicketCest
{
    /** @var Faker\Generator $faker - генератор фейковых данных */
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
     * Список видов билетов
     * @param ApiTester $I
     * @return void
     */
    public function indexTest(ApiTester $I): void
    {
        $I->amGoingTo('Получить список видов билета');
        $I->sendGet('/ticket/');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть список видов билета в формате JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Запись вида билета
     * @param ApiTester $I
     * @return void
     */
    public function viewTest(ApiTester $I): void
    {
        $I->amGoingTo('Получить одну запись вида билета');
        $I->sendGet('/ticket/');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть одну запись вида билета в формате JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Создание записи вида билета
     * @param ApiTester $I
     * @return void
     */
    public function createTest(ApiTester $I): void
    {
        $I->amGoingTo('Создать запись вида билета');
        $I->sendPost('/ticket/create', [
            'event_id' => 1,
            'price' => 300,
            'privilege' => $this->faker->text(30),
        ]);
        $I->seeResponseCodeIs(HttpCode::CREATED);

        $I->expectTo('Увидеть запись вида билета в формате JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Обновление записи вида билета
     * @param ApiTester $I
     * @return void
     */
    public function updateTest(ApiTester $I): void
    {
        $I->amGoingTo('Обновить запись вида билета');
        $I->sendPut('/ticket/update?id=1', ['privilege' => 'test']);
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть только что обновлённую запись вида билета в формате JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Удаление записи вида билета
     * @param ApiTester $I
     * @return void
     */
    public function deleteTest(ApiTester $I): void
    {
        $I->amGoingTo('Удалить запись вида билета');
        $I->sendDelete('/ticket/delete?id=1');
        $I->seeResponseCodeIs(HttpCode::NO_CONTENT);
    }
}
