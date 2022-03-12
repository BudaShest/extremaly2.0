<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%place}}`.
 */
class m220308_130711_create_place_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%place}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(256)->unique()->notNull(),
            'address' => $this->string(256)->unique()->notNull(),
            'description' => $this->text()->notNull(),
            'climat_code' => $this->string(8)->notNull(),
            'country_code' => $this->string(2)->notNull(),
        ]);

        $this->createIndex(
            'idx-place-climat_code',
            'place',
            'climat_code',
        );

        $this->addForeignKey(
            'fk-place-climat_code',
            'place',
            'climat_code',
            'climat',
            'code',
            'CASCADE',
            'CASCADE',
        );

        $this->createIndex(
            'idx-place-country_code',
            'place',
            'country_code',
        );

        $this->addForeignKey(
            'fk-place-country_code',
            'place',
            'country_code',
            'country',
            'code',
            'CASCADE',
            'CASCADE',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-place-country_code', 'place');

        $this->dropIndex('idx-place-country_code', 'place');

        $this->dropForeignKey('fk-place-climat_code', 'place');

        $this->dropIndex('idx-place-climat_code', 'place');

        $this->dropTable('{{%place}}');
    }
}
