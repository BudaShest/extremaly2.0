<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%review}}`.
 */
class m220312_105816_create_review_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%review}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'text' => $this->text()->notNull(),
            'rating' => $this->integer(1)->notNull(),
            'is_visible' => $this->boolean()->defaultValue(true),
            'created_at' => 'datetime NOT NULL DEFAULT CURRENT_TIMESTAMP', //не факт что будет робить
        ]);

        $this->createIndex(
            'idx-review-user_id',
            'review',
            'user_id'
        );

        $this->addForeignKey(
            'fk-review-user_id',
            'review',
            'user_id',
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
        $this->dropForeignKey('fk-review-user_id', 'review');

        $this->dropIndex('idx-review-user_id', 'review');

        $this->dropTable('{{%review}}');
    }
}
