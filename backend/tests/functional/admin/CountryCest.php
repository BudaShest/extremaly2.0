<?php
namespace admin;

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
        //todo сюда авторизацию приебенить
    }

    /**
     * Страница со списком всех стран
     * @param FunctionalTester $I
     * @covers ::actionIndex
     */
    public function indexTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Открыть страницу со списком всех стран');
        $I->amOnPage('/country/index');
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
        $I->amOnPage('/country/create');
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
        $I->amOnPage('/place/view');
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
        $I->amGoingTo('');
        $I->amOnPage('');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('');
        $I->see("Управление страной");
    }
}
