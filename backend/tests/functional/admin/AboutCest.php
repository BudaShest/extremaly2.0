<?php
namespace admin;

use Codeception\Util\HttpCode;
use FunctionalTester;
use app\modules\admin\controllers\AboutController;

/**
 * @coversDefaultClass AboutController
 */
class AboutCest
{
    public function _before(FunctionalTester $I)
    {
    }

    /**
     * Страница со списком всех записей "О нас"
     * @param FunctionalTester $I
     * @covers ::actionIndex
     */
    public function indexTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Посетить страницу со списком всех записей "О нас"');
        $I->amOnPage('/about/index');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть страницу со списком всех записей "О нас"');
        $I->see("О нас");
    }

    /**
     * Страница создания записи "О нас"
     * @param FunctionalTester $I
     * @return void
     */
    public function createTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Посетить страницу создания записи "О нас"');
        $I->amOnPage('/about/create');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть страницу создания записи "О нас"');
        $I->see("О нас");
    }

    /**
     * Страница просмотра детальной информации записи "О нас"
     * @param FunctionalTester $I
     * @return void
     */
    public function viewTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Посетить страницу просмотра детальной информации записи "О нас"');
        $I->amOnPage('/about/view?id=1');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть страницу просмотра детальной информации записи "О нас"');
        $I->see("О нас");
    }

    /**
     * Страница обновления информации "О нас"
     * @param FunctionalTester $I
     * @return void
     */
    public function updateTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Посетить страницу обновления информации "О нас"');
        $I->amOnPage('/about/update?id=1');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Посетить страницу обновления информации "О нас"');
        $I->see("О нас");
    }
}
