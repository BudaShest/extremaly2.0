<?php
namespace functional\admin;

use Codeception\Util\HttpCode;
use FunctionalTester;

class MainCest
{
    public function _before(FunctionalTester $I)
    {
    }

    /**
     * Страница авторизации
     * @param FunctionalTester $I
     * @return void
     */
    public function loginTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Посетить страницу авторизации');
        $I->amOnPage('/main/login');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть страницу авторизации');
        $I->see('Добро пожаловать в админ панель!');
    }

    /**
     * Главная страница
     * @param FunctionalTester $I
     * @return void
     */
    public function indexTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Посетить главную страницу');
        $I->amOnPage('/main/login');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть главную страницу');
        $I->see('Логин в админ-панеле');
    }

//    /** todo испрвить сам метод */
//     * @param FunctionalTester $I
//     * @return void
//     */
//    public function logoutTest(FunctionalTester $I): void
//    {
//        $I->amGoingTo('');
//        $I->amOnPage('');
//        $I->seeResponseCodeIs(HttpCode::OK);
//
//        $I->expectTo('');
//        $I->see();
//    }
}
