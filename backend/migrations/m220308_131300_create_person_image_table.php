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
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%person_image}}');
    }
}
