<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%event_person}}`.
 */
class m220308_131357_create_event_person_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%event_person}}', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%event_person}}');
    }
}
