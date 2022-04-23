<?php

namespace functional\admin;

use Codeception\Util\HttpCode;
use FunctionalTester;

class AdvantageCest
{
    public function _before(FunctionalTester $I)
    {
    }

    /**
     * Страница со списком всех преимущества
     * @param FunctionalTester $I
     * @return void
     */
    public function indexTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Посетить страницу со списком всех преимущества');
        $I->amOnPage('/advantage/index');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть страницу со списком всех преимущества');
        $I->see('Все преимущества');
    }

    /**
     * Создание записи преимущества
     * @param FunctionalTester $I
     * @return void
     */
    public function createTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Посетить страницу с формой добавления записи преимущества');
        $I->amOnPage('/advantage/create');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть страницу с формой добавления записи преимущества');
        $I->see("Добавление преимущества");
    }

    /**
     * Страница просмотра информации о преимуществе
     * @param FunctionalTester $I
     * @return void
     */
    public function viewTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Посетить страницу просмотра информации о преимуществе');
        $I->amOnPage('/advantage/view?id=1');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть страницу просмотра информации о преимуществе');
        $I->see("Преимущество");
    }

    /**
     * Обновление информации о преимуществе
     * @param FunctionalTester $I
     * @return void
     */
    public function updateTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Посетить страницу с формой обновления информации о преимуществе');
        $I->amOnPage('/advantage/update?id=1');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть страницу с формой обновления информации о преимуществе');
        $I->see('Управление преимуществом');
    }
}
