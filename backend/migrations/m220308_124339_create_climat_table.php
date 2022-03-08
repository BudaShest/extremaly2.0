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
            'code' => $this->string(2)->unique(),
            'name' => $this->string(64)->unique(),
            'icon' => $this->string(256)->unique(),
        ]);

        $this->addPrimaryKey(
        'pk-climat-code',
            'cilmat',
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
