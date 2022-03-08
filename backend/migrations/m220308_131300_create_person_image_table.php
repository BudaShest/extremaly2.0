<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%person_image}}`.
 */
class m220308_131300_create_person_image_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%person_image}}', [
            'id' => $this->primaryKey(),
            'person_id' => $this->integer()->notNull(),
            'image' => $this->string(256)->notNull(),
        ]);

        $this->createIndex(
            'idx-person_image-person_id',
            'person_image',
            'person_id'
        );

        $this->addForeignKey(
        'fk-person_image-person_id',
            'person_image',
            'person_id',
            'person',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-person_image-person_id', 'person_image');

        $this->dropIndex('idx-person_image-person_id', 'person_image');

        $this->dropTable('{{%person_image}}');
    }
}
