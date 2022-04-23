<?php
namespace functional\admin;

use Codeception\Util\HttpCode;
use FunctionalTester;

class TicketCest
{
    public function _before(FunctionalTester $I)
    {
    }

    /**
     * Страница со списком всех видов билетов
     * @param FunctionalTester $I
     * @return void
     */
    public function indexTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Посетить страницу со списком всех видов билетов');
        $I->amOnPage('/ticket/index');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть страницу со списком всех видов билетов');
        $I->see('Все билеты');
    }

    /**
     * Страница добавления типов билетов
     * @param FunctionalTester $I
     * @return void
     */
    public function createTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Посетить страницу добавления типов билетов');
        $I->amOnPage('/ticket/create');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть страницу добавления типов билетов');
        $I->see('Добавить билеты');
    }
}
