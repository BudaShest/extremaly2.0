<?php

use yii\db\Migration;

/**
 * Class m220308_165848_create_junction_table_for_event_and_person
 */
class m220308_165848_create_junction_table_for_event_and_person extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('event_person',[
            'event_id' => $this->integer()->notNull(),
            'person_id' => $this->integer()->notNull(),
            'created_at' => $this->dateTime(),
        ]);

        $this->addPrimaryKey('pk-event_person','event_person', ['event_id','person_id']);

        $this->createIndex(
            'idx-event_person-event_id',
            'event_person',
            'event_id'
        );

        $this->addForeignKey(
        'fk-event_person-event_id',
            'event_person',
            'event_id',
            'event',
            'id',
        'CASCADE',
        'CASCADE'
        );

        $this->createIndex(
        'idx-event_person-person_id',
            'event_person',
            'person_id'
        );

        $this->addForeignKey(
            'fk-event_person-person_id',
            'event_person',
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
        $this->dropForeignKey('fk-event_person-person_id','event_person');

        $this->dropIndex('idx-event_person-person_id','event_person');

        $this->dropForeignKey('fk-event_person-event_id','event_person');

        $this->dropIndex('idx-event_person-event_id','event_person');

        $this->dropTable('event_person');
    }
}
