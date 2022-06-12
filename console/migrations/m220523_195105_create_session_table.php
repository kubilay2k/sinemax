<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%session}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%movie}}`
 * - `{{%theater}}`
 */
class m220523_195105_create_session_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%session}}', [
            'id' => $this->primaryKey(),
            'movie_id' => $this->integer(11),
            'theater_id' => $this->integer(11),
            'day' => $this->string(55),
            'time' => $this->string(55),
            'cost' => $this->string(11),
        ]);

        // creates index for column `movie_id`
        $this->createIndex(
            '{{%idx-session-movie_id}}',
            '{{%session}}',
            'movie_id'
        );

        // add foreign key for table `{{%movie}}`
        $this->addForeignKey(
            '{{%fk-session-movie_id}}',
            '{{%session}}',
            'movie_id',
            '{{%movie}}',
            'id',
            'CASCADE'
        );

        // creates index for column `theater_id`
        $this->createIndex(
            '{{%idx-session-theater_id}}',
            '{{%session}}',
            'theater_id'
        );

        // add foreign key for table `{{%theater}}`
        $this->addForeignKey(
            '{{%fk-session-theater_id}}',
            '{{%session}}',
            'theater_id',
            '{{%theater}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%movie}}`
        $this->dropForeignKey(
            '{{%fk-session-movie_id}}',
            '{{%session}}'
        );

        // drops index for column `movie_id`
        $this->dropIndex(
            '{{%idx-session-movie_id}}',
            '{{%session}}'
        );

        // drops foreign key for table `{{%theater}}`
        $this->dropForeignKey(
            '{{%fk-session-theater_id}}',
            '{{%session}}'
        );

        // drops index for column `theater_id`
        $this->dropIndex(
            '{{%idx-session-theater_id}}',
            '{{%session}}'
        );

        $this->dropTable('{{%session}}');
    }
}
