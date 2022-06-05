<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%message}}`.
 */
class m220604_071313_create_message_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%message}}', [
            'id' => $this->primaryKey(),
            'from_id' => $this->integer()->notNull(),
            'to_id' => $this->integer()->notNull(),
            'text' => $this->text()->notNull(),
            'was_read' => $this->boolean()->notNull(),
            'created_at' => 'datetime NOT NULL DEFAULT CURRENT_TIMESTAMP'
        ]);

        $this->createIndex(
            'idx-message-from_id',
            'message',
            'from_id',
        );

        $this->addForeignKey(
            'fk-message-from_id',
            'message',
            'from_id',
            'user',
            'id',
            'CASCADE',
            'CASCADE',
        );

        $this->createIndex(
            'idx-message-to_id',
            'message',
            'to_id',
        );

        $this->addForeignKey(
            'fk-message-to_id',
            'message',
            'to_id',
            'user',
            'id',
            'CASCADE',
            'CASCADE',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-message-to_id', 'message');

        $this->dropIndex('idx-message-to_id', 'message');

        $this->dropForeignKey('fk-message-from_id', 'message');

        $this->dropIndex('idx-message-from_id', 'message');

        $this->dropTable('{{%message}}');
    }
}
