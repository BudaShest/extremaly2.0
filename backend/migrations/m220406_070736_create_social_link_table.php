<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%social_link}}`.
 */
class m220406_070736_create_social_link_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%social_link}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'icon' => $this->string()->notNull(),
            'url' => $this->string()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%social_link}}');
    }
}
