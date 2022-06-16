<?php
namespace functional\admin;

use FunctionalTester;
use Codeception\Util\HttpCode;

class PersonLinkCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amLogin($I);
    }

    /**
     * Страница со списком соц. сетей личностей
     * @param FunctionalTester $I
     * @covers ::actionIndex
     */
    public function indexTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Посетить страницу со списком соц. сетей личностей');
        $I->amOnPage('/admin/person-link/index');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть страницу со списком соц. сетей личностей');
        $I->see("Соц. сети личностей");
    }

    /**
     * Страница создания соц. сети личности
     * @param FunctionalTester $I
     * @covers ::actionCreate
     */
    public function createTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Посетить страницу добавления соц. сети личности');
        $I->amOnPage('/admin/person-link/create');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть страницу добавления соц. сети личности');
        $I->see("Управление соц. сетями персон");
    }

    /**
     * Страница просмотра детальной информации о соц. сети личности
     * @param FunctionalTester $I
     * @return void
     */
    public function viewTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Посетить страницу просмотра детальной информации о соц. сети личности');
        $I->amOnPage('/admin/person-link/view?id=1');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть страницу просмотра детальной информации о соц. сети личности');
        $I->see("Соц. сеть личности");
    }

    /**
     * Страница обновления соц. сети личности
     * @param FunctionalTester $I
     * @return void
     */
    public function updateTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Посетить страницу обновления соц. сети личности');
        $I->amOnPage('/admin/person-link/update?id=1');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть страницу обновления соц. сети личности');
        $I->see("Управление соц. сетями персон");
    }
}
