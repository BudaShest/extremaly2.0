<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ticket}}`.
 */
class m220308_131203_create_ticket_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ticket}}', [
            'id' => $this->primaryKey(),
            'event_id' => $this->integer()->notNull(),
            'price' => $this->integer(8)->notNull(),
            'privilege' => $this->string(256)->notNull(),
            'description' => $this->text()->null(),
        ]);

        $this->createIndex(
            'idx-ticket-event_id',
            'ticket',
            'event_id'
        );

        $this->addForeignKey(
            'fk-ticket-event_id',
            'ticket',
            'event_id',
            'event',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-ticket-event_id',
            'ticket'
        );

        $this->dropIndex('idx-ticket-event_id', 'ticket');

        $this->dropTable('{{%ticket}}');
    }
}
