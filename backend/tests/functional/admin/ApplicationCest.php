<?php
namespace admin;

use Codeception\Util\HttpCode;
use FunctionalTester;

class ApplicationCest
{
    public function _before(FunctionalTester $I)
    {
    }

    /**
     * Страница со списком всех заявок
     * @param FunctionalTester $I
     * @return void
     */
    public function indexTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Посетить страницу со списком всех заявок');
        $I->amOnPage('/application/index');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть страницу со списком всех заявок');
        $I->see('Управление заявками');
    }

    /**
     * Страница обновления статуса заявки
     * @param FunctionalTester $I
     * @return void
     */
    public function updateTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Посетить страницу обновления статуса заявки');
        $I->amOnPage('/application/update?id=1');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть страницу обновления статуса заявки');
        $I->see('Управление заявками');
    }
}
