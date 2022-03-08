<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%climat}}`.
 */
class m220308_124339_create_climat_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%climat}}', [
            'code' => $this->string(8)->unique()->notNull(),
            'name' => $this->string(64)->unique()->notNull(),
            'icon' => $this->string(256)->notNull(),
        ]);

        $this->addPrimaryKey(
        'pk-climat-code',
            'climat',
            'code',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%climat}}');
    }
}
