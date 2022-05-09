<?php

use Codeception\Util\HttpCode;
use Faker\Factory;

class ClimatCest
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
     * Список записей климата
     * @param ApiTester $I
     * @return void
     */
    public function indexTest(ApiTester $I): void
    {
        $I->amGoingTo('Получить список записей климата');
        $I->sendGet('/climat');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть список записей климата в формате JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Просмотр записи климата
     * @param ApiTester $I
     * @return void
     */
    public function viewTest(ApiTester $I): void
    {
        $I->amGoingTo('Получить одну запись климата');
        $I->sendGet('/climat/view?id=HOT');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть одну запись климата в формате JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Создать запись климата
     * @param ApiTester $I
     * @return void
     */
    public function createTest(ApiTester $I): void
    {
        $I->amGoingTo('Создать запись климата');
        $I->sendPost('/climat/create', [
            'code' => 'TEST',
            'name' => $this->faker->text(20),
            'icon' => 'test.img',
        ]);
        $I->seeResponseCodeIs(HttpCode::CREATED);

        $I->expectTo('Получить только что созданную запись в формате JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Обновить запись климата
     * @param ApiTester $I
     * @return void
     */
    public function updateTest(ApiTester $I): void
    {
        $I->amGoingTo('Обновить');
        $I->sendPut('/climat/update?id=HOT', ['name' => 'test']);
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Получить только что обновлённую запись в формате JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Удалить запись климата
     * @param ApiTester $I
     * @return void
     */
    public function deleteTest(ApiTester $I): void
    {
        $I->amGoingTo('Удалить запись климата');
        $I->sendDelete('/climat/delete?id=HOT');
        $I->seeResponseCodeIs(HttpCode::NO_CONTENT);
    }
}
