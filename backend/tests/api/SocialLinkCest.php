<?php

use Codeception\Util\HttpCode;
use Faker\Factory;

class SocialLinkCest
{
    /** @var \Faker\Generator $faker */
    protected Faker\Generator $faker;

    /**
     * Внедрение зависимости
     */
    public function _inject()
    {
        $this->faker = Factory::create('ru-RU');
    }

    /**
     * Список соц. сетей проекта
     * @param ApiTester $I
     */
    public function indexTest(ApiTester $I): void
    {
        $I->amGoingTo('Получить список соц. сетей проекта');
        $I->sendGet('/social-link');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть список соц. сетей проекта в формате JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Просмотр соц. сети проекта
     * @param ApiTester $I
     */
    public function viewTest(ApiTester $I): void
    {
        $I->amGoingTo('Получить запись соц. сети проекта');
        $I->sendGet('/social-link/view?id=1');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть запись соц. сети проекта в формате JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Создание записи соц. сети проекта
     * @param ApiTester $I
     */
    public function createTest(ApiTester $I): void
    {
        $I->amGoingTo('Создать запись соц. сети проекта');
        $I->sendPost('/social-link/create', [
            'title' => $this->faker->text(11),
            'icon' => "test.jpg",
            'url' => $this->faker->url,
        ]);
        $I->seeResponseCodeIs(HttpCode::CREATED);

        $I->expectTo('Увидеть только что созданную запись в формате JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Обновление записи соц. сети проекта
     * @param ApiTester $I
     */
    public function updateTest(ApiTester $I): void
    {
        $I->amGoingTo('Обновить запись соц. сети проекта');
        $I->sendPut('/social-link/update?id=1', ['title' => 'test']);
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть только что обновлённую запись в формате JSON');
        $I->seeResponseIsJson();
    }

    /**
     * Удаление записи соц. сети проекта
     * @param ApiTester $I
     */
    public function deleteTest(ApiTester $I): void
    {
        $I->amGoingTo('Удалить запись соц. сети проекта');
        $I->sendDelete('/social-link/delete?id=1');
        $I->seeResponseCodeIs(HttpCode::NO_CONTENT);
    }
}
