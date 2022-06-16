<?php
namespace functional\admin;

use Codeception\Util\HttpCode;
use FunctionalTester;

class MainCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amLogin($I);
    }

    /**
     * Страница авторизации
     * @param FunctionalTester $I
     * @return void
     */
    public function loginTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Посетить страницу авторизации');
        $I->amOnPage('/admin/main/login');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть страницу авторизации');
        $I->see('Логин в админ-панели');
    }

    /**
     * Главная страница
     * @param FunctionalTester $I
     * @return void
     */
    public function indexTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Посетить главную страницу');
        $I->amOnPage('/admin/main/index');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть главную страницу');
        $I->see('Добро пожаловать в админ панель!');
    }

    /**
     * Выход
     * @param FunctionalTester $I
     * @return void
     */
    public function logoutTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Выйти из учётной записи');
        $I->amOnPage('/admin/main/logout');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Выйти и увидеть форму авторизации');
        $I->see('Логин в админ-панели');
    }
}
