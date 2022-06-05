<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ticket_application}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%ticket}}`
 * - `{{%application}}`
 */
class m220407_092516_create_junction_table_for_ticket_and_application_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ticket_application}}', [
            'ticket_id' => $this->integer(),
            'application_id' => $this->integer(),
            'PRIMARY KEY(ticket_id, application_id)',
        ]);

        // creates index for column `ticket_id`
        $this->createIndex(
            '{{%idx-ticket_application-ticket_id}}',
            '{{%ticket_application}}',
            'ticket_id'
        );

        // add foreign key for table `{{%ticket}}`
        $this->addForeignKey(
            '{{%fk-ticket_application-ticket_id}}',
            '{{%ticket_application}}',
            'ticket_id',
            '{{%ticket}}',
            'id',
            'CASCADE'
        );

        // creates index for column `application_id`
        $this->createIndex(
            '{{%idx-ticket_application-application_id}}',
            '{{%ticket_application}}',
            'application_id'
        );

        // add foreign key for table `{{%application}}`
        $this->addForeignKey(
            '{{%fk-ticket_application-application_id}}',
            '{{%ticket_application}}',
            'application_id',
            '{{%application}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%ticket}}`
        $this->dropForeignKey(
            '{{%fk-ticket_application-ticket_id}}',
            '{{%ticket_application}}'
        );

        // drops index for column `ticket_id`
        $this->dropIndex(
            '{{%idx-ticket_application-ticket_id}}',
            '{{%ticket_application}}'
        );

        // drops foreign key for table `{{%application}}`
        $this->dropForeignKey(
            '{{%fk-ticket_application-application_id}}',
            '{{%ticket_application}}'
        );

        // drops index for column `application_id`
        $this->dropIndex(
            '{{%idx-ticket_application-application_id}}',
            '{{%ticket_application}}'
        );

        $this->dropTable('{{%ticket_application}}');
    }
}
