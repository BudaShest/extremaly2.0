<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%event_type}}`.
 */
class m220308_130353_create_event_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%event_type}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(64)->unique()->notNull(),
            'icon' => $this->string(256)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%event_type}}');
    }
}
