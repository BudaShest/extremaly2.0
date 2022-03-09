<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%person}}`.
 */
class m220308_131235_create_person_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%person}}', [
            'id' => $this->primaryKey(),
            'firstname' => $this->string(64)->notNull(),
            'lastname' => $this->string(64),
            'age' => $this->integer(3)->notNull(),
            'description' => $this->text(),
            'profession' => $this->text()->defaultValue('гражданин мира'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%person}}');
    }
}
