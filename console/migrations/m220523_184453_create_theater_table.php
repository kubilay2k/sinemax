<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%_theater}}`.
 */
class m220523_184453_create_theater_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%theater}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%theater}}');
    }
}
