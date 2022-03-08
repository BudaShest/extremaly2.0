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
            'place_id' => $this->integer()->notNull(),
            'image' => $this->string(256)->notNull(),
        ]);

        $this->createIndex(
        'idx-place_image-place_id',
            'place_image',
            'place_id',
        );

        $this->addForeignKey(
        'fk-place_image_place_id',
            'place_image',
            'place_id',
            'place',
            'id',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-place_image_place_id','place_image');

        $this->dropTable('{{%place_image}}');
    }
}
