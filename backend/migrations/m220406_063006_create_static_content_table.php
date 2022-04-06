<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%static_content}}`.
 */
class m220406_063006_create_static_content_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%static_content}}', [
            'id' => $this->primaryKey(),
            'image' => $this->string(256)->notNull(),
            'title' => $this->string(65)->notNull(),
            'text' =>  $this->text()->null()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%static_content}}');
    }
}
