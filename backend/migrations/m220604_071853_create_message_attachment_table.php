<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%message_attachment}}`.
 */
class m220604_071853_create_message_attachment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%message_attachment}}', [
            'id' => $this->primaryKey(),
            'message_id' => $this->integer()->notNull(),
            'path' => $this->integer()->notNull()
        ]);

        $this->createIndex(
            'idx-message_attachment-message_id',
            'message_attachment',
            'message_id'
        );

        $this->addForeignKey(
            'fk-message_attachment-message_id',
            'message_attachment',
            'message_id',
            'message',
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
        $this->dropForeignKey('fk-message_attachment-message_id', 'message_attachment');

        $this->dropIndex('idx-message_attachment-message_id', 'message_attachment');

        $this->dropTable('{{%message_attachment}}');
    }
}
