<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_event}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%event}}`
 */
class m220308_170806_create_junction_table_for_user_and_event_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_event}}', [
            'user_id' => $this->integer(),
            'event_id' => $this->integer(),
            'created_at' => 'datetime NOT NULL DEFAULT CURRENT_TIMESTAMP', //не факт что будет робить
        ]);

        $this->addPrimaryKey('pk-user_event', 'user_event', ['user_id', 'event_id']);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-user_event-user_id}}',
            '{{%user_event}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-user_event-user_id}}',
            '{{%user_event}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `event_id`
        $this->createIndex(
            '{{%idx-user_event-event_id}}',
            '{{%user_event}}',
            'event_id'
        );

        // add foreign key for table `{{%event}}`
        $this->addForeignKey(
            '{{%fk-user_event-event_id}}',
            '{{%user_event}}',
            'event_id',
            '{{%event}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-user_event-user_id}}',
            '{{%user_event}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-user_event-user_id}}',
            '{{%user_event}}'
        );

        // drops foreign key for table `{{%event}}`
        $this->dropForeignKey(
            '{{%fk-user_event-event_id}}',
            '{{%user_event}}'
        );

        // drops index for column `event_id`
        $this->dropIndex(
            '{{%idx-user_event-event_id}}',
            '{{%user_event}}'
        );

        $this->dropTable('{{%user_event}}');
    }
}
