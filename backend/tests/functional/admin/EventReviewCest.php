<?php
namespace admin;

use Codeception\Util\HttpCode;
use FunctionalTester;

class EventReviewCest
{
    public function _before(FunctionalTester $I)
    {
    }

    /**
     * Страница со списком всех комментариев к событию
     * @param FunctionalTester $I
     * @return void
     */
    public function indexTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Посетить страницу со списком всех комментариев к событию');
        $I->amOnPage('/event-review/index');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть страницу со списком всех комментариев к событию');
        $I->see('Комментарии к событиям');
    }

    /**
     * Страница просмотра детальной информации комментария к событию
     * @param FunctionalTester $I
     * @return void
     */
    public function viewTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Посетить страницу просмотра детальной информации комментария к событию');
        $I->amOnPage('/event-review/view?id=1');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть страницу просмотра детальной информации комментария к событию');
        $I->see('Комментарий к событию');
    }

    /**
     * Страница обновления информации комментария к событию
     * @param FunctionalTester $I
     * @return void
     */
    public function updateTest(FunctionalTester $I): void
    {
        $I->amGoingTo('Посетить страницу обновления информации комментария к событию');
        $I->amOnPage('/event-review/update?id=1');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('Увидеть страницу обновления информации комментария к событию');
        $I->see('Редактирование комментария');
    }
}
