<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%event_image}}`.
 */
class m220308_131035_create_event_image_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%event_image}}', [
            'id' => $this->primaryKey(),
            'event_id' => $this->integer()->notNull(),
            'image' => $this->string(256)->notNull(),
        ]);

        $this->createIndex(
            'idx-event_image-event_id',
            'event_image',
            'event_id'
        );

        $this->addForeignKey(
            'fk-event_image-event_id',
            'event_image',
            'event_id',
            'event',
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
        $this->dropForeignKey('fk-event_image-event_id', 'event_image');

        $this->dropIndex('idx-event_image-event_id', 'event_image');

        $this->dropTable('{{%event_image}}');
    }
}
