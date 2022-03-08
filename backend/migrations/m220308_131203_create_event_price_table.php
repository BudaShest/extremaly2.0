<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%event_price}}`.
 */
class m220308_131203_create_event_price_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%event_price}}', [
            'id' => $this->primaryKey(),
            'event_id' => $this->integer()->notNull(),
            'price' => $this->integer(8)->notNull(),
            'privilege' => $this->string(256)->notNull(),
        ]);

        $this->createIndex(
        'idx-event_price-event_id',
            'event_price',
            'event_id'
        );

        $this->addForeignKey(
            'fk-event_price_event_id',
            'event_price',
            'event_id',
            'event',
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
        $this->dropForeignKey(
            'fk-event_price_event_id',
            'event_price'
        );

        $this->dropIndex('idx-event_price-event_id','event_price');

        $this->dropTable('{{%event_price}}');
    }
}
