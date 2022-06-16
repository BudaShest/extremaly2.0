<?php
namespace functional\admin;

use Codeception\Util\HttpCode;
use FunctionalTester;

class ReviewCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amLogin($I);
    }

    /**
     * Страница со списком всех отзывов
     * @param FunctionalTester $I
     * @return void
     */
    public function indexTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Посетить страницу со списком всех отзывов');
        $I->amOnPage('/admin/review/index');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть страницу со списком всех отзывов');
        $I->see('Вcе отзывы');
    }

    /**
     * Страница просмотра отзыва о проекте
     * @param FunctionalTester $I
     * @return void
     */
    public function viewTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Посетить страницу просмотра отзыва о проекте');
        $I->amOnPage('/admin/review/view?id=1');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть страницу просмотра отзыва о проекте');
        $I->see('Отзыв о проекте');
    }

    /**
     * Страница обновления отзыва о проекте
     * @param FunctionalTester $I
     * @return void
     */
    public function updateTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Посетить страницу обновления отзыва о проекте');
        $I->amOnPage('/admin/review/update?id=1');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть страницу обновления отзыва о проекте');
        $I->see('Управление отзывом');
    }
}
