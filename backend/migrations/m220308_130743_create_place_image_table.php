<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%place_image}}`.
 */
class m220308_130743_create_place_image_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%place_image}}', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%place_image}}');
    }
}
