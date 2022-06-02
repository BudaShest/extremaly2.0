<?php

namespace app\commands;

use yii\console\Controller;
use app\models\services\MockBuilder;

/**
 * Контроллер для заполнения базы данных мокововыми данными
 */
class MockController extends Controller
{
    /**
     * Страны
     * @param int $numOfRows - кол-во строк
     * @return int - статус операции
     */
    public function actionCountry(int $numOfRows): int
    {
        return MockBuilder::createCountryRows($numOfRows);
    }

    /**
     * Климат
     * @param int $numOfRows - кол-во строк
     * @return int - статус операции
     */
    public function actionClimat(int $numOfRows): int
    {
        return MockBuilder::createClimatRows($numOfRows);
    }

    /**
     * Тип события
     * @param int $numOfRows - кол-во строк
     * @return int - статус операции
     */
    public function actionEventType(int $numOfRows): int
    {
        return MockBuilder::createEventTypeRows($numOfRows);
    }

    /**
     * Места
     * @param int $numOfRows - кол-во строк
     * @return int - статус операции
     */
    public function actionPlace(int $numOfRows): int
    {
        return MockBuilder::createPlaceRows($numOfRows);
    }

    /**
     * События
     * @param int $numOfRows - кол-во строк
     * @return int - статус операции
     */
    public function actionEvent(int $numOfRows): int
    {
        return MockBuilder::createEventRows($numOfRows);
    }

    /**
     * Билеты
     * @param int $numOfRows - кол-во строк
     * @return int - статус операции
     */
    public function actionTicket(int $numOfRows): int
    {
        return MockBuilder::createTicketRows($numOfRows);
    }

    /**
     * Личности
     * @param int $numOfRows - кол-во строк
     * @return int - статус операции
     */
    public function actionPerson(int $numOfRows): int
    {
        return MockBuilder::createPersonRows($numOfRows);
    }

    /**
     * Статический контент главной старнциы
     * @param int $numOfRows - кол-во строк
     * @return int - статус операции
     */
    public function actionStaticContent(int $numOfRows): int
    {
        return MockBuilder::createStaticContentRows($numOfRows);
    }

    /**
     * Соц. сети персон
     * @param int $numOfRows - кол-во строк
     * @return int - статус операции
     */
    public function actionPersonLink(int $numOfRows): int
    {
        return MockBuilder::createPersonLinkRows($numOfRows);
    }

    /**
     * Социальные сети проекта
     * @param int $numOfRows - кол-во строк
     * @return int - статус операции
     */
    public function actionSocialLink(int $numOfRows): int
    {
        return MockBuilder::createSocialLinkRows($numOfRows);
    }

    /**
     * Отзывы к событиям
     * @param int $numOfRows - кол-во строк
     * @return int - статус операции
     */
    public function actionEventReview(int $numOfRows): int
    {
        return MockBuilder::createEventReviewRows($numOfRows);
    }

    /**
     * Отзывы к проекты
     * @param int $numOfRows - кол-во строк
     * @return int - статус операции
     */
    public function actionReview(int $numOfRows): int
    {
        return MockBuilder::createReviewRows($numOfRows);
    }
}
