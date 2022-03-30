<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m220308_131432_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'login' => $this->string(32)->unique()->notNull(),
            'password' => $this->string(256)->notNull(),
            'email' => $this->string(128)->unique(),
            'phone' => $this->string(16)->unique(),
            'avatar' => $this->string(256),
            'role_id' => $this->integer()->notNull(),
            'access_token' => $this->string(256)->notNull(),
            ''
        ]);

        $this->createIndex(
            'idx-user-role_id',
            'user',
            'role_id'
        );

        $this->addForeignKey(
            'fk-user-role_id',
            'user',
            'role_id',
            'role',
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
        $this->dropForeignKey('fk-user-role_id', 'user');

        $this->dropIndex('idx-user-role_id', 'user');

        $this->dropTable('{{%user}}');
    }
}
