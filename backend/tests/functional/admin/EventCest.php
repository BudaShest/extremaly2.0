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

    /**
     * Страница со списком всех событий
     * @param FunctionalTester $I
     * @return void
     */
    public function indexTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Протестировать страницу со списком событий');
        $I->amOnPage('/event');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть страницу со списком всех событий');
        $I->see('Все события');
    }

    /**
     * Страница добавления события
     * @param FunctionalTester $I
     * @return void
     */
    public function createTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Протестировать страницу добавления события');
        $I->amOnPage('/event/create');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть страницу добавления события');
        $I->see('');
    }

    /**
     * Страница просмотра события
     * @param FunctionalTester $I
     * @return void
     */
    public function viewTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Посетить страницу просмотра детальной информации о событии');
        $I->amOnPage('/event/view?id=1');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть страницу просмотра детальной информации о событии');
        $I->see('Событие');
    }

    /**
     * Страница обновления информации о событии
     * @param FunctionalTester $I
     * @return void
     */
    public function updateTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Посетить страницу обновления информации о событии');
        $I->amOnPage('/event/view?id=1');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Посетить страницу просмотра детальной информации о событии');
        $I->see('Управление событием');
    }
}
