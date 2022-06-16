<?php

namespace admin;

use Codeception\Util\HttpCode;
use FunctionalTester;

class StaticContentCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amLogin($I);
    }

    /**
     * Страница со списком записей статического контента
     * @param FunctionalTester $I
     * @return void
     */
    public function indexTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Посетить страницу со списком записей статического контента');
        $I->amOnPage('/admin/static-content/index');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть список записей статического контента');
        $I->see('Статический контент');
    }

    /**
     * Страница с формой создания записей статического контента
     * @param FunctionalTester $I
     * @return void
     */
    public function createTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Посетить страницу с формой создания записей статического контента');
        $I->amOnPage('/admin/static-content/create');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть страницу с формой создания записей статического контента');
        $I->see('Управление статичным контентом');
    }

    /**
     * Страница просмотра записи статического контента
     * @param FunctionalTester $I
     * @return void
     */
    public function viewTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Посетить страницу просмотра записи статического контента');
        $I->amOnPage('/admin/static-content/view?id=1');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть страницу просмотра записи статического контента');
        $I->see('Статический контент');
    }

    public function updateTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Посетить страницу с формой обновления записи статического контента');
        $I->amOnPage('/admin/static-content/update?id=1');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть страницу с формой обновления записи статического контента');
        $I->see('Управление статичным контентом');
    }
}
