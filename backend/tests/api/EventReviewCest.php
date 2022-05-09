<?php

use Codeception\Util\HttpCode;
use Faker\Factory;

class EventReviewCest
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
     * Список комментариев к событию
     * @param ApiTester $I
     * @return void
     */
    public function indexTest(ApiTester $I): void
    {
        $I->amGoingTo('Получить список комментариев к событию');
        $I->sendGet('/event-review');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expect('Получить список комментариев к событию в формате JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Комментарий к событию
     * @param ApiTester $I
     * @return void
     */
    public function viewTest(ApiTester $I): void
    {
        $I->amGoingTo('Получить комментарий к событию');
        $I->sendGet('/event-review/view?id=1');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Получить комментарий к событию в формате JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Создать запись комментария к событию
     * @param ApiTester $I
     * @return void
     */
    public function createTest(ApiTester $I): void
    {
        $I->amGoingTo('Создать запись комментария к событию');
        $I->sendPost('/event-review/create', [
            'user_id' => 1,
            'event_id' => 1,
            'text' => $this->faker->text(30),
            'rating' => 5,
        ]);
        $I->seeResponseCodeIs(HttpCode::CREATED);

        $I->expectTo('Увидеть только что созданную запись комментария к событию в формате JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Обновление записи
     * @param ApiTester $I
     * @return void
     */
    public function updateTest(ApiTester $I): void
    {
        $I->amGoingTo('Обновить запись комментария к событию');
        $I->sendPut('/event-review/update?id=1', ['text' => 'test']);
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть только что обновлённую запись комментария к событию в формате JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Удаление записи
     * @param ApiTester $I
     * @return void
     */
    public function deleteTest(ApiTester $I): void
    {
        $I->amGoingTo('Удалить');
        $I->sendDelete('/event-review/delete?id=1');
        $I->seeResponseCodeIs(HttpCode::NO_CONTENT);
    }
}
