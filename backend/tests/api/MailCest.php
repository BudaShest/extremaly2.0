<?php

use Codeception\Util\HttpCode;

class MailCest
{
    /**
     * Отправка письма
     * @param ApiTester $I
     * @return void
     */
    public function sendMailTest(ApiTester $I): void
    {
        $I->amGoingTo('Отправить письмо');
        $I->sendPost('/main/send-mail');
        $I->seeResponseCodeIs(HttpCode::CREATED);

        $I->expectTo('Увидеть ответ со статусом отправки в формате JSON');
        $I->seeResponseIsJson();
    }
}
