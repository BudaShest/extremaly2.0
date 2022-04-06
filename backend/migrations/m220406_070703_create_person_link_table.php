<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%person_link}}`.
 */
class m220406_070703_create_person_link_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%person_link}}', [
            'id' => $this->primaryKey(),
            'person_id' => $this->integer()->notNull(),
            'title' => $this->string()->notNull(),
            'icon' => $this->string()->notNull(),
            'url' => $this->string()->notNull()
        ]);

        $this->createIndex('idx-person_link-person_id', 'person_link', 'person_id');

        $this->addForeignKey(
            'fk-person_link-person_id',
            'person_link',
            'person_id',
            'person',
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
        $this->dropForeignKey('fk-person_link-person_id', 'person_link');

        $this->dropIndex('idx-person_link-person_id', 'person_link');

        $this->dropTable('{{%person_link}}');
    }
}
