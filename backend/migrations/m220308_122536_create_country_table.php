<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%country}}`.
 */
class m220308_122536_create_country_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%country}}', [
            'code' => $this->string(2)->unique()->notNull(),
            'name' => $this->string(64)->unique()->notNull(),
            'flag' => $this->string(256)->notNull(),
        ]);

        $this->addPrimaryKey(
        'pk-country-code',
        'country',
        'code'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%country}}');
    }
}
