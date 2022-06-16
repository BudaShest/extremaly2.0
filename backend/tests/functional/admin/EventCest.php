<?php
namespace admin;

use FunctionalTester;
use Codeception\Util\HttpCode;

/**
 * Класс для тестирования раздела "События"
 */
class EventCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amLogin($I);
    }

    /**Place
     * Страница со списком всех событий
     * @param FunctionalTester $I
     * @return void
     */
    public function indexTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Протестировать страницу со списком событий');
        $I->amOnPage('/admin/event/index');
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
        $I->amOnPage('/admin/event/create');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть страницу добавления события');
        $I->see('Добавить событие');
    }

    /**
     * Страница просмотра события
     * @param FunctionalTester $I
     * @return void
     */
    public function viewTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Посетить страницу просмотра детальной информации о событии');
        $I->amOnPage('/admin/event/view?id=1');
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
        $I->amOnPage('/admin/event/update?id=1');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Посетить страницу просмотра детальной информации о событии');
        $I->see('Управление событием');
    }
}
