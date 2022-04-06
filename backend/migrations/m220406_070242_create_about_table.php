<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%about}}`.
 */
class m220406_070242_create_about_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%about}}', [
            'id' => $this->primaryKey(),
            'text' => $this->text()->null(),
            'small_text' => $this->text()->null(),
            'image' => $this->string()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%about}}');
    }
}
