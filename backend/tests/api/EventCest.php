<?php

use Codeception\Util\HttpCode;
use Faker\Factory;

class EventCest
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
        $I->sendGet('/event/get-events-by-age?age=20');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Получить события в формате JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Получить события, подходящие для детей
     * @param ApiTester $I
     * @return void
     */
    public function getEventsForKidsTest(ApiTester $I): void
    {
        $I->amGoingTo('Получить события, подходящие для детей');
        $I->sendGet('/event/get-events-for-kids');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть события, подходящие для детей в формате JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Получить события, с максимальным приоритетом
     * @param ApiTester $I
     * @return void
     */
    public function getEventsByPriorityTest(ApiTester $I): void
    {
        $I->amGoingTo('Получить события, с максимальным приоритетом');
        $I->sendGet('/event/get-events-by-priority');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть соыбтия с максимальным приоритетом в формате JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Получить события только для взрослых
     * @param ApiTester $I
     * @return void
     */
    public function getEventsForOldsTest(ApiTester $I): void
    {
        $I->amGoingTo('Получить события только для взрослых');
        $I->sendGet('/event/get-events-for-olds');
        $I->seeResponseIsJson(HttpCode::OK);

        $I->expectTo('Увидеть события только для взрослых в формате JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Получить события по типу климата
     * @param ApiTester $I
     * @return void
     */
    public function getEventsByClimatTest(ApiTester $I): void
    {
        $I->amGoingTo('Получить события по типу климата');
        $I->sendGet('/event/get-events-by-climat?code=HOT');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть события по типу климата в формате JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Получить события по стране проведения
     * @param ApiTester $I
     * @return void
     */
    public function getEventsByCountryTest(ApiTester $I): void
    {
        $I->amGoingTo('Получить события по стране проведения');
        $I->sendGet('/event/get-events-by-country?code=US');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть события по стране проведения в формате JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Найти события
     * @param ApiTester $I
     * @return void
     */
    public function getEventsByFoundedTest(ApiTester $I): void
    {
        $I->amGoingTo('Найти события');
        $I->sendGet('/event/get-events-by-founded?requestedString='.urlencode('Блэк'));
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть найденные события в формате JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Получить события по месту
     * @param ApiTester $I
     * @return void
     */
    public function getEventsByPlaceTest(ApiTester $I): void
    {
        $I->amGoingTo('Получить события по месту');
        $I->sendGet('/event/get-events-by-place?placeId=1');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть события места в формате JSON');
        $I->seeResponseIsJson();
    }
}
