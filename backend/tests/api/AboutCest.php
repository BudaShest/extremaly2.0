<?php

use Codeception\Util\HttpCode;
use Faker\Factory;

class AboutCest
{
    /** @var Faker\Generator $faker - генератор фейковых данных */
    protected $faker;

    /**
     * Внедрение зависимости
     * @return void
     */
    public function _inject()
    {
        $this->faker = Factory::create('ru-RU');
    }

    /**
     * Список записей "О нас"
     * @param ApiTester $I
     * @return void
     */
    public function indexTest(ApiTester $I): void
    {
        $I->amGoingTo('Получить список записей "О нас"');
        $I->sendGet('/about');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть список записей "О нас" в формате JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Запись "О нас"
     * @param ApiTester $I
     * @return void
     */
    public function viewTest(ApiTester $I): void
    {
        $I->amGoingTo('Получить запись "О нас"');
        $I->sendGet('/about/view?id=1');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть запись "О нас"');
        $I->seeResponseIsJson();
    }

    /**
     * Создать запись "О нас"
     * @param ApiTester $I
     * @return void
     */
    public function createTest(ApiTester $I): void
    {
        $I->amGoingTo('Создать запись "О нас"');
        $I->sendPost('/about/create', [
            'text' => $this->faker->text(20),
            'small_text' => $this->faker->text(120),
            'image' => "test.img"
        ]);
        $I->seeResponseCodeIs(HttpCode::CREATED);

        $I->expectTo('Получить только что созданную запись в формате JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Обновить запись "О нас"
     * @param ApiTester $I
     * @return void
     */
    public function updateTest(ApiTester $I): void
    {
        $I->amGoingTo('Обновить запись "О нас"');
        $I->sendPut('/about/update?id=1', ['text' => 'test']);
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Получить уже изменённую запись в формате JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Удалить запись "О нас"
     * @param ApiTester $I
     * @return void
     */
    public function deleteTest(ApiTester $I): void
    {
        $I->amGoingTo('Удалить запись "О нас"');
        $I->sendDelete('/about/delete?id=1');
        $I->seeResponseCodeIs(HttpCode::NO_CONTENT);
    }
}
