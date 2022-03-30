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
            'user_id' => $this->integer()->notNull(), //todo миграцию и ip в юзера
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%banned}}');
    }
}
