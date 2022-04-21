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
        $I->see();
    }

    /**
     * Обновление информации о преимуществе
     * @param FunctionalTester $I
     * @return void
     */
    public function createTest(FunctionalTester $I): void
    {
        $I->amGoingTo('');
        $I->amOnPage('');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('');
        $I->see();
    }

    /**
     * Страница просмотра информации о преимуществе
     * @param FunctionalTester $I
     * @return void
     */
    public function viewTest(FunctionalTester $I): void
    {
        $I->amGoingTo('');
        $I->amOnPage('');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('');
        $I->see();
    }

    /**
     * Обновление информации о преимуществе
     * @param FunctionalTester $I
     * @return void
     */
    public function updateTest(FunctionalTester $I): void
    {
        $I->amGoingTo('');
        $I->amOnPage('');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('');
        $I->see();
    }
}
