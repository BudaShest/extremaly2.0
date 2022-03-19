<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%event}}`.
 */
class m220308_130950_create_event_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%event}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(256)->unique()->notNull(),
            'offer' => $this->string(256),
            'from' => $this->dateTime(),
            'until' => $this->dateTime(),
            'description' => $this->text(),
            'age_restrictions' => $this->integer(2)->notNull()->defaultValue(12),
            'priority' => $this->integer(1)->notNull()->defaultValue(1), //card-size also
            'is_horizontal' => $this->boolean()->notNull()->defaultValue(true),
            'place_id' => $this->integer()->notNull(),
            'type_id' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-event-place_id',
            'event',
            'place_id'
        );

        $this->addForeignKey(
            'fk-event-place_id',
            'event',
            'place_id',
            'place',
            'id',
            'CASCADE',
            'CASCADE',
        );

        $this->createIndex(
            'idx-event-type_id',
            'event',
            'type_id'
        );

        $this->addForeignKey(
            'fk-event-type_id',
            'event',
            'type_id',
            'event_type',
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
        $this->dropForeignKey('fk-event-type_id', 'event');

        $this->dropIndex('idx-event-type_id', 'event');

        $this->dropForeignKey('fk-event-place_id', 'event');

        $this->dropIndex('idx-event-place_id', 'event');

        $this->dropTable('{{%event}}');
    }
}
