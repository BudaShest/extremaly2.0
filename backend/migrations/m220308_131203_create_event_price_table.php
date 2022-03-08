<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%event_price}}`.
 */
class m220308_131203_create_event_price_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%event_price}}', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%event_price}}');
    }
}
