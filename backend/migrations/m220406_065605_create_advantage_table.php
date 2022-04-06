<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%advantage}}`.
 */
class m220406_065605_create_advantage_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%advantage}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(64)->notNull(),
            'text' => $this->text()->null(),
        ]);

        $this->batchInsert('advantage', ['title', 'text'], [
            ['Мы сотрудничаем напрямую с организаторами!', 'Именно поэтому Вы можете быть уверены, что не переплатите деньги из за услуг посредников. Также Вы всегда будете знать, кто ответственен за организацию мероприятия. Просто расслабьтесь и положитесь на нас!'],
            ['Мы предлагаем только активный отдых!', 'Весь отпуск пролежать в отеле, смотря телевизор и опустошая минибар - это не про нас и наших клиентов! Мы предлагаем только активный и необычных отдых, так что можете быть уверены - скучно вам точно не будет!'],
            ['Мы подготовим всё для вашего отдыха!','Команда Extremly берёт все организационные вопросы и моменты на себя. Всё что от Вас требуется - приобрести билеты, подготовить документы и вещи и прибыть на пункт сбора во время! Так что будьте спокойны - мы всё сделаем за Вас!' ]
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%advantage}}');
    }
}
