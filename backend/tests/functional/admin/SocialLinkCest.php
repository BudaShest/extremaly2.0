<?php
namespace admin;

use Codeception\Util\HttpCode;

class SocialLinkCest
{
    public function _before(FunctionalTester $I)
    {
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
