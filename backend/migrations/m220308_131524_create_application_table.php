<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%application}}`.
 */
class m220308_131524_create_application_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        //todo
        $this->createTable('{{%application}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'event_price_id' => $this->integer()->notNull(),
            'num' => $this->integer()->notNull(),
            'status_id' => $this->integer()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%application}}');
    }
}
