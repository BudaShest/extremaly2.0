<?php

use Codeception\Util\HttpCode;
use Faker\Factory;

class EventCest
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
     * Список событий
     * @param ApiTester $I
     * @return void
     */
    public function indexTest(ApiTester $I): void
    {
        $I->amGoingTo('Получить список событий');
        $I->sendGet('/event');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expect('Увидеть список событий в формате JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Запись события
     * @param ApiTester $I
     * @return void
     */
    public function viewTest(ApiTester $I): void
    {
        $I->amGoingTo('Получить запись события');
        $I->sendGet('/event/view?id=1');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть запись события в формате JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Создание записи события
     * @param ApiTester $I
     * @return void
     */
    public function createTest(ApiTester $I): void
    {
        $I->amGoingTo('Создать запись события');
        $I->sendPost('/event/create', [
            'name' => $this->faker->text(20),
            'offer' => $this->faker->text(120),
//            'from' => '', //todo даты не работают(
//            'until' => '',
            'description' => $this->faker->text(256),
            'age_restrictions' => 18,
            'priority' => 1,
            'place_id' => 1,
            'type_id' => 1,
            'ticket_num' => 100,
        ]);
        $I->seeResponseCodeIs(HttpCode::CREATED);

        $I->expectTo('Увидеть только что созданную запись в формате JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Обновления записи события
     * @param ApiTester $I
     * @return void
     */
    public function updateTest(ApiTester $I): void
    {
        $I->amGoingTo('Обновить запись события');
        $I->sendPut('/event/update?id=1', ['name' => 'test']);
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expect('Увидеть только что созданную запись в формате JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Удаление записи события
     * @param ApiTester $I
     * @return void
     */
    public function deleteTest(ApiTester $I): void
    {
        $I->amGoingTo('Удалить запись события');
        $I->sendDelete('/event/delete?id=1');
        $I->seeResponseCodeIs(HttpCode::NO_CONTENT);
    }

    /**
     * Получить события по возрастному ограничению
     * @param ApiTester $I
     * @return void
     */
    public function getEventsByAgeTest(ApiTester $I): void
    {
        $I->amGoingTo('Получить события по возрастному ограничению');
        $I->sendGet('/event/get-events-by-age');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Получить события в формате JSON');
        $I->seeResponseIsJson();
    }

}
