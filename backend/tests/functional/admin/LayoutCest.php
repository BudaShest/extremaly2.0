<?php
namespace admin;

use Codeception\Util\HttpCode;
use FunctionalTester;

class LayoutCest
{
    public function _before(FunctionalTester $I)
    {
        die;
        //TODO данный класс является шаблонным, этот тест не должен испольняться!
    }


    public function indexTest(FunctionalTester $I): void
    {
        $I->amGoingTo('');
        $I->amOnPage('');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('');
        $I->see();
    }

    public function createTest(FunctionalTester $I): void
    {
        $I->amGoingTo('');
        $I->amOnPage('');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('');
        $I->see();
    }

    public function viewTest(FunctionalTester $I): void
    {
        $I->amGoingTo('');
        $I->amOnPage('');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('');
        $I->see();
    }

    public function updateTest(FunctionalTester $I): void
    {
        $I->amGoingTo('');
        $I->amOnPage('');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->expectTo('');
        $I->see();
    }
}
