<?php
namespace functional\admin;

use Codeception\Util\HttpCode;
use FunctionalTester;

class EventTypeCest
{
    public function _before(FunctionalTester $I)
    {
    }

    /**
     * Страница с просмотром всех типов событий
     * @param FunctionalTester $I
     * @return void
     */
    public function indexTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Посетить страницу с просмотром всех типов событий');
        $I->amOnPage('/event-type/index');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть страницу с просмотром всех типов событий');
        $I->see('Вcе типы событий');
    }

    /**
     * Страница добавления типов событий
     * @param FunctionalTester $I
     * @return void
     */
    public function createTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Посетить страницу добавления типов событий');
        $I->amOnPage('/event-type/create');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть страницу добавления типов событий');
        $I->see('Добавить тип события');
    }

    /**
     * Страница просмотра детальной информации о типе события
     * @param FunctionalTester $I
     * @return void
     */
    public function viewTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Посетить страницу просмотра детальной информации о типе события');
        $I->amOnPage('/event-type/view?id=1');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть страницу просмотра детальной информации о типе события');
        $I->see('Тип событий');
    }

    /**
     * Страница обновления информации о типе события
     * @param FunctionalTester $I
     * @return void
     */
    public function updateTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Посетить страницу обновления информации о типе события');
        $I->amOnPage('/event-type/update?id=1');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть страницу обновления информации о типе события');
        $I->see('Управление типом события');
    }
}
