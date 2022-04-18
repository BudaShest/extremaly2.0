<?php
namespace admin;

use FunctionalTester;
use Codeception\Util\HttpCode;

class EventCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amGoingTo('Пройти авторизацию');
        $I->amOnPage('/admin/main/login');
        $I->see('Login');
//        $I->submitForm('#login-form',[
//            'LoginForm[login]' => 'admin',
//            'LoginForm[password]' => 'admin'
//        ]);
//        $I->seeResponseCodeIs(HttpCode::OK);
    }

    public function indexTest(FunctionalTester $I)
    {
        $I->amGoingTo('Протестировать страницу со списком событий');
        $I->amOnPage('/event');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть страницу со списком всех событий');
        $I->see('Все события');
    }
}
