<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%event_image}}`.
 */
class m220308_131035_create_event_image_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%event_image}}', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%event_image}}');
    }
}
