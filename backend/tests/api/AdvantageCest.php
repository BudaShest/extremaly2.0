<?php

use Codeception\Util\HttpCode;
use Faker\Factory;

class AdvantageCest
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
     * Список преимуществ
     * @param ApiTester $I
     */
    public function indexTest(ApiTester $I): void
    {
        $I->amGoingTo('Получить список');
        $I->sendGet('/advantage');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть список преимуществ');
        $I->seeResponseIsJson();
    }

    /**
     * Запись преимущества
     * @param ApiTester $I
     */
    public function viewTest(ApiTester $I): void
    {
        $I->amGoingTo('Получить запись преимущества');
        $I->sendGet('/advantage/view?id=1');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть запись преимущества');
        $I->seeResponseIsJson();
    }

    /**
     * Создание записи преимущества
     * @param ApiTester $I
     */
    public function createTest(ApiTester $I): void
    {
        $I->amGoingTo('Создать запись преимущества');
        $I->sendPost('/advantage/create', [
            'title' => $this->faker->text(20),
            'text' => $this->faker->text(120),
        ]);
        $I->seeResponseCodeIs(HttpCode::CREATED);

        $I->expectTo('Получить только что созданную запись преимущества');
        $I->seeResponseIsJson();
    }

    /**
     * Обновление записи преимущества
     * @param ApiTester $I
     */
    public function updateTest(ApiTester $I): void
    {
        $I->amGoingTo('Обновить запись преимущества');
        $I->sendPut('/advantage/update?id=1', ['title' => 'test']);
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть обновлённую запись преимущества');
        $I->seeResponseIsJson();
    }

    /**
     * Удаление записи преимущества
     * @param ApiTester $I
     */
    public function deleteTest(ApiTester $I): void
    {
        $I->amGoingTo('Удалить запись преимущества');
        $I->sendDelete('/advantage/delete?id=1');
        $I->seeResponseCodeIs(HttpCode::NO_CONTENT);
    }
}
