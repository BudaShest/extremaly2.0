<?php
namespace admin;

use Codeception\Util\HttpCode;
use FunctionalTester;
use const http\Client\Curl\Features\HTTP2;

class ApplicationCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amGoingTo('Авторизоваться под административной учётной записью');
        $I->amOnPage('/admin/main/login');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->see('Логин в админ-панели');
        $I->submitForm('#login-form', [
            'LoginForm' => [
                'login' => 'admin',
                'password' => 'admin',
            ]
        ]);
        $I->see('Добро пожаловать в админ панель!');
    }

    /**
     * Страница со списком всех заявок
     * @param FunctionalTester $I
     * @return void
     */
    public function indexTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Посетить страницу со списком всех заявок');
        $I->amOnPage('/admin/application/index');
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
        $I->amOnPage('/admin/application/update?id=1');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть страницу обновления статуса заявки');
        $I->see('Управление заявками');
    }
}
