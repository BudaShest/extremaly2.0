<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%application}}`.
 */
class m220308_131524_create_application_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%application}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'num' => $this->integer()->notNull(),
            'status_id' => $this->integer()->notNull()->defaultValue(1),
            'created_at' => 'datetime NOT NULL DEFAULT CURRENT_TIMESTAMP', //не факт что будет робить
        ]);

        $this->createIndex(
            'idx-application-user_id',
            'application',
            'user_id'
        );

        $this->addForeignKey(
            'fk-application-user_id',
            'application',
            'user_id',
            'user',
            'id',
            'CASCADE',
            'CASCADE'
        );


        $this->createIndex(
            'idx-application-status_id',
            'application',
            'status_id'
        );

        $this->addForeignKey(
            'fk-application-status_id',
            'application',
            'status_id',
            'status',
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
        $this->dropForeignKey('fk-application-status_id', 'application');

        $this->dropIndex('idx-application-status_id', 'application');

        $this->dropForeignKey('fk-application-user_id', 'application');

        $this->dropIndex('idx-application-user_id', 'application');

        $this->dropTable('{{%application}}');
    }
}
