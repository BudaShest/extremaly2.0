<?php

namespace functional\admin;

use FunctionalTester;
use Codeception\Util\HttpCode;
use app\modules\admin\controllers\PersonController;

/**
 * Функциональные тесты для ресурсов "Персоны"
 * @coversDefaultClass PersonController
 */
class PersonCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amLogin($I);
    }

    /**
     * Страница "Все персоны"
     * @param FunctionalTester $I
     * @covers ::actionIndex
     */
    public function indexTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Посетить страницу со списком всех персон');
        $I->amOnPage('/admin/person/index');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть страницу со списком всех персон');
        $I->see("Все персоны");
    }

    /**
     * Страница с формой добавления персоны
     * @param FunctionalTester $I
     * @covers ::actionCreate
     */
    public function createTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Посетить страницу с формой добавления личности');
        $I->amOnPage('/admin/person/create');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть страницу с формой добавления личности');
        $I->see('Добавить личность');
    }

    /**
     * Страница просмотра детальной информации о личности
     * @param FunctionalTester $I
     * @covers ::actionView
     */
    public function viewTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Посетить страницу просмотра детальной информации о личности');
        $I->amOnPage('/admin/person/view?id=1');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть страницу просмотра детальной информации о личности');
        $I->see('Информация о личности');
    }

    /**
     * Страница обновления информации о личности
     * @param FunctionalTester $I
     * @covers ::actionUpdate
     */
    public function updateTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Посетить страницу обновления информации о личности');
        $I->amOnPage('/admin/person/update?id=1');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть страницу обновления инфморации о личности');
        $I->see("Управление личностью");
    }
}
