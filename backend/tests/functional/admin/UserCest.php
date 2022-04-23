<?php
namespace functional\admin;

use Codeception\Util\HttpCode;
use FunctionalTester;

class UserCest
{
    public function _before(FunctionalTester $I)
    {
    }

    /**
     * Страница со списком всех пользователей
     * @param FunctionalTester $I
     * @return void
     */
    public function indexTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Посетить страницу со списком всех пользователей');
        $I->amOnPage('/user/index');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть страницу со списком всех пользователей');
        $I->see('Все пользователи');
    }

    /**
     * Страница просмотра пользовательской информации
     * @param FunctionalTester $I
     * @return void
     */
    public function viewTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Посетить страницу просмотра пользовательской информации');
        $I->amOnPage('/user/view?id=1');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть страницу просмотра пользовательской информации');
        $I->see('Пользователь');
    }
}
