<?php

use Codeception\Util\HttpCode;
use Faker\Factory;

class ApplicationCest
{
    /** @var \Faker\Generator $faker */
    protected Faker\Generator $faker;

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
     * Список всех заявок
     * @param ApiTester $I
     * @return void
     */
    public function indexTest(ApiTester $I): void
    {
        $I->amGoingTo('Получить список заявок');
        $I->sendGet('/application');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expect('Увидеть список заявок в формате JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Просмотр одной заявки
     * @param ApiTester $I
     * @return void
     */
    public function viewTest(ApiTester $I): void
    {
        $I->amGoingTo('Получить одну заявку');
        $I->sendGet('/application/view?id=1');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть одну заявку в формате JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Создание заявки
     * @param ApiTester $I
     * @return void
     */
    public function createTest(ApiTester $I): void
    {
        $I->amGoingTo('Создать заявку');
        $I->sendPost('/application/create-application', [
            'user_id' => 1,
            'tickets' => [
                [
                    'id' => 1,
                    'cnt' => 2,
                ]
            ]
        ]);
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть созданную заявку в формате JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Обновление заявки
     * @param ApiTester $I
     * @return void
     */
    public function updateTest(ApiTester $I): void
    {
        $I->amGoingTo('Обновить');
        $I->sendPut('/application/update?id=1', ['num' => 100]);
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expect('Увидеть обновленную заявку в формате JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Удаление заявки
     * @param ApiTester $I
     * @return void
     */
    public function deleteTest(ApiTester $I): void
    {
        $I->amGoingTo('Удалить');
        $I->sendDelete('/application/delete?id=1');
        $I->seeResponseCodeIs(HttpCode::NO_CONTENT);
    }

    /**
     * Получение заявок по пользователю
     * @param ApiTester $I
     * @return void
     */
    public function getApplicationsByUserTest(ApiTester $I): void
    {
        $I->amGoingTo('Получить заявки по пользователю');
        $I->sendGet('/application/get-applications-by-user?userId=1');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Получить заявки по пользователю в формате JSON');
        $I->seeResponseIsJson();
    }
}
