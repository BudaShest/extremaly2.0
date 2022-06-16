<?php

namespace functional\admin;

use FunctionalTester;
use Codeception\Util\HttpCode;
use app\modules\admin\controllers\ClimatController;

/**
 * Класс для тестирования раздела "Климат"
 * @coversDefaultClass ClimatController
 */
class ClimatCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amLogin($I);
    }

    /**
     * Страница со списком всеъ видов климата
     * @param FunctionalTester $I
     * @covers ::actionIndex
     */
    public function indexTest(FunctionalTester $I)
    {
        $I->amGoingTo('Посетить страницу со списком видов климата');
        $url = $I->grabFromCurrentUrl();

        $I->amOnPage('/admin/climat/index');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть список всех видов климата');
        $I->see('Климат');
    }

    /**
     * Страница обновления информации по виду климата
     * @param FunctionalTester $I
     * @covers ::actionUpdate
     */
    public function updateTest(FunctionalTester $I)
    {
        $I->amGoingTo('Посетить страницу с изменением информации по виду климата');
        $I->amOnPage('/admin/climat/update?code=HOT');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть форму управления информацией о климате');
        $I->see('Управление климатом');
    }

    /**
     * Страница создания записи вида климата
     * @param FunctionalTester $I
     * @covers ::actionCreate
     */
    public function createTest(FunctionalTester $I)
    {
        $I->amGoingTo('Посетить страницу создания записи вида климата');
        $I->amOnPage('/admin/climat/create');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть форму управления климатом');
        $I->see('Управление климатом');
    }

    /**
     * Страница просмотра детальной информации о типе климата
     * @param FunctionalTester $I
     * @covers ::actionView
     */
    public function viewTest(FunctionalTester $I)
    {
        $I->amGoingTo('Посетить страницу просмотра детальной информации о типе климата');
        $I->amOnPage('/admin/climat/view?code=HOT');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть страницу с детальной информацией о климате');
        $I->see('Климат');
    }
}
