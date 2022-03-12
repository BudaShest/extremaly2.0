<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%event_review}}`.
 */
class m220312_105838_create_event_review_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%event_review}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'event_id' => $this->integer()->notNull(),
            'text' => $this->text()->notNull(),
            'rating' => $this->integer(1)->notNull(),
            'created_at' => 'datetime NOT NULL DEFAULT CURRENT_TIMESTAMP', //не факт что будет робить
        ]);

        $this->createIndex(
            'idx-event_review-user_id',
            'event_review',
            'user_id'
        );

        $this->addForeignKey(
            'fk-event_review-user_id',
            'event_review',
            'user_id',
            'user',
            'id',
            'CASCADE',
            'CASCADE',
        );

        $this->createIndex(
            'idx-event_review-event_id',
            'event_review',
            'event_id',
        );

        $this->addForeignKey(
            'fk-event_review-event_id',
            'event_review',
            'event_id',
            'event',
            'id',
            'CASCADE',
            "CASCADE",
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-event_review-event_id', 'event_review');

        $this->dropIndex('idx-event_review-event_id', 'event_review');

        $this->dropForeignKey('fk-event_review-user_id', 'event_review');

        $this->dropIndex('idx-event_review-user_id', 'event_review');

        $this->dropTable('{{%event_review}}');
    }
}
