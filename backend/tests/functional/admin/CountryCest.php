<?php
namespace functional\admin;

use Codeception\Util\HttpCode;
use FunctionalTester;
use app\modules\admin\controllers\CountryController;

/**
 * Класс для тестирования раздела "Места"
 * @coversDefaultClass CountryController
 */
class CountryCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amLogin($I);
    }

    /**
     * Страница со списком всех стран
     * @param FunctionalTester $I
     * @covers ::actionIndex
     */
    public function indexTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Открыть страницу со списком всех стран');
        $I->amOnPage('/admin/country/index');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть страницу со списком всех стран');
        $I->see("Страны");
    }

    /**
     * Страница добавления страны
     * @param FunctionalTester $I
     * @covers ::actionCreate
     */
    public function createTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Открыть страницу с формой добавления страны');
        $I->amOnPage('/admin/country/create');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть страницу с формой добавления страны');
        $I->see("Управление страной");
    }

    /**
     * Страница просмотра детальной информации о стране
     * @param FunctionalTester $I
     * @covers ::actionView
     */
    public function viewTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Открыть страницу просмотра детальной информации о стране');
        $I->amOnPage('/admin/country/view?code=RU');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть страницу просмотра детальной информации о стране');
        $I->see("Страна");
    }

    /**
     * Страница с формой обновления информации о стране
     * @param FunctionalTester $I
     * @covers ::actionUpdate
     */
    public function updateTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Посетить страницу с формой обновления информации о стране');
        $I->amOnPage('/admin/country/update?code=RU');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть страницу с формой обновления информации о стране');
        $I->see("Управление страной");
    }
}
