<?php

namespace admin;

use FunctionalTester;
use Codeception\Util\HttpCode;
use app\modules\admin\controllers\PlaceController;

/**
 * Класс для тестирования раздела "Места"
 * @coversDefaultClass PlaceController
 */
class PlaceCest
{
    public function _before(FunctionalTester $I)
    {
        //todo сюда авторизацию приебенить
    }

    /**
     * Страница "Все место"
     * @param FunctionalTester $I
     * @covers ::actionIndex
     */
    public function indexTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Открыть страницу со списком всех мест');
        $I->amOnPage('/place/index');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть страницу со списком всех мест');
        $I->see("Места");
    }

    /**
     * Страница "Добавить место"
     * @param FunctionalTester $I
     * @covers ::actionCreate
     */
    public function createTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Открыть страницу с формой добавления места');
        $I->amOnPage('/place/create');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть страницу с формой добавления места');
        $I->see("Добавить место");
    }

    /**
     * Страница "Просмотр места"
     * @param FunctionalTester $I
     * @covers ::actionView
     */
    public function viewTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Открыть страницу с детальной информацией о места');
        $I->amOnPage('/place/view?id=1');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть страницу просмотра детальной информации о месте');
        $I->see("Место");
    }

    /**
     * Стрранца "Обновление места"
     * @param FunctionalTester $I
     * @covers ::actionUpdate
     */
    public function updateTest(FunctionalTester $I)
    {
        $I->amGoingTo('Открыть страницу обновления информации о месте');
        $I->amOnPage('/place/update?id=1');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть страницу обновления информации о месте');
        $I->see("Обновление места");
    }
}
