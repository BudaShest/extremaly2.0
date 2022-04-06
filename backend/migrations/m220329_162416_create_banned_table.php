<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%banned}}`.
 */
class m220329_162416_create_banned_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%banned}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull()->unique(),
            'reason' => $this->string(128),
            'created_at' => 'datetime NOT NULL DEFAULT CURRENT_TIMESTAMP',
        ]);

        $this->createIndex('idx-banned_user_id', 'banned', 'user_id');

        $this->addForeignKey(
            'fk-banned_user_id',
            'banned',
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
        $this->dropForeignKey('fk-banned_user_id', 'banned');

        $this->dropIndex('idx-banned_user_id', 'banned');

        $this->dropTable('{{%banned}}');
    }
}
