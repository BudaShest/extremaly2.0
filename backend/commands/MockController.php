<?php

namespace app\commands;

use app\models\Ticket;
use yii\console\Controller;
use app\models\services\MockBuilder;

class MockController extends Controller
{
    public function actionCountry(int $numOfRows)
    {
        return MockBuilder::createCountryRows($numOfRows);
    }

    public function actionClimat(int $numOfRows)
    {
        return MockBuilder::createClimatRows($numOfRows);
    }

    public function actionEventType(int $numOfRows)
    {
        return MockBuilder::createEventTypeRows($numOfRows);
    }

    public function actionPlace(int $numOfRows)
    {
        return MockBuilder::createPlaceRows($numOfRows);
    }

    public function actionEvent(int $numOfRows)
    {
        return MockBuilder::createEventRows($numOfRows);
    }

    public function actionTicket(int $numOfRows)
    {
        return MockBuilder::createTicketRows($numOfRows);
    }

    public function actionPerson(int $numOfRows)
    {
        return MockBuilder::createPersonRows($numOfRows);
    }

    public function actionStaticContent(int $numOfRows)
    {
        return MockBuilder::createStaticContentRows($numOfRows);
    }

    public function actionPersonLink(int $numOfRows)
    {
        return MockBuilder::createPersonLinkRows($numOfRows);
    }

    public function actionSocialLink(int $numOfRows)
    {
        return MockBuilder::createSocialLinkRows($numOfRows);
    }
}