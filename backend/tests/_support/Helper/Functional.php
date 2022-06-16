<?php

namespace Helper;

use Codeception\Util\HttpCode;
use FunctionalTester;

class Functional extends \Codeception\Module
{
    public function amLogin(FunctionalTester $I)
    {
        $I->amGoingTo('Авторизоваться под административной учётной записью');
        $I->amOnPage('/admin/main/login');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->see('Логин в админ-панели');
        $I->submitForm('#login-form', [
            'LoginForm' => [
                'login' => 'admin',
                'password' => 'admin',
            ]
        ]);
        $I->see('Добро пожаловать в админ панель!');
    }

}