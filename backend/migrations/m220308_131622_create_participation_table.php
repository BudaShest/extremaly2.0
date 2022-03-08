<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%participation}}`.
 */
class m220308_131622_create_participation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%participation}}', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%participation}}');
    }
}
