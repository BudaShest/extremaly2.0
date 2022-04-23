<?php
namespace functional\admin;

use Codeception\Util\HttpCode;
use FunctionalTester;

class SocialLinkCest
{
    public function _before(FunctionalTester $I)
    {
    }

    /**
     * Страница со списком соц. сетей проекта
     * @param FunctionalTester $I
     * @return void
     */
    public function indexTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Посетить страницу со списком соц. сетей проекта');
        $I->amOnPage('/social-link/index');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть страницу со списком соц. сетей проекта');
        $I->see('Социальные сети проекта');
    }

    /**
     * Страница добавления социальной стеи
     * @param FunctionalTester $I
     * @return void
     */
    public function createTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Посетить страницу добавления социальной сети');
        $I->amOnPage('/social-link//create');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть страницу добавления социальной стеи');
        $I->see('Добавить социальную сети');
    }

    /**
     * Страница просмотра информации о соц. сети проекта
     * @param FunctionalTester $I
     * @return void
     */
    public function viewTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Посетить страницу просмотра информации о соц. сети проекта');
        $I->amOnPage('/social-link/view?id=1');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть страницу просмотра информации о соц. сети проекта');
        $I->see('Социальная сеть');
    }

    /**
     * Страница обновления информации о соц. сети проекта
     * @param FunctionalTester $I
     * @return void
     */
    public function updateTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Посетить страницу обновления информации о соц. сети проекта');
        $I->amOnPage('/social-link/update?id=1');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть страницу обновления информации о соц. сети проекта');
        $I->see('Управление социальной сетью');
    }
}
