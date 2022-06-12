<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ticket}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%session}}`
 * - `{{%user}}`
 */
class m220523_201705_create_ticket_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ticket}}', [
            'id' => $this->primaryKey(),
            'session_id' => $this->integer(11),
            'user_id' => $this->integer(11),
        ]);

        // creates index for column `session_id`
        $this->createIndex(
            '{{%idx-ticket-session_id}}',
            '{{%ticket}}',
            'session_id'
        );

        // add foreign key for table `{{%session}}`
        $this->addForeignKey(
            '{{%fk-ticket-session_id}}',
            '{{%ticket}}',
            'session_id',
            '{{%session}}',
            'id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-ticket-user_id}}',
            '{{%ticket}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-ticket-user_id}}',
            '{{%ticket}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%session}}`
        $this->dropForeignKey(
            '{{%fk-ticket-session_id}}',
            '{{%ticket}}'
        );

        // drops index for column `session_id`
        $this->dropIndex(
            '{{%idx-ticket-session_id}}',
            '{{%ticket}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-ticket-user_id}}',
            '{{%ticket}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-ticket-user_id}}',
            '{{%ticket}}'
        );

        $this->dropTable('{{%ticket}}');
    }
}
