<?php
namespace admin;

use AcceptanceTester;

class AuthCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function loginTest(AcceptanceTester $I)
    {
        $I->amOnPage('/');
    }
}
