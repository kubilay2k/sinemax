<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%movie}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%category}}`
 */
class m220523_193728_create_movie_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%movie}}', [
            'id' => $this->primaryKey(),
            'movie_name' => $this->string(255),
            'movie_description' => $this->string(255),
            'time' => $this->string(55),
            'image' => $this->string(55),
            'director' => $this->string(55),
            'actors' => $this->string(255),
            'category_id' => $this->integer(11),
        ]);

        // creates index for column `category_id`
        $this->createIndex(
            '{{%idx-movie-category_id}}',
            '{{%movie}}',
            'category_id'
        );

        // add foreign key for table `{{%category}}`
        $this->addForeignKey(
            '{{%fk-movie-category_id}}',
            '{{%movie}}',
            'category_id',
            '{{%category}}',
            'category_id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%category}}`
        $this->dropForeignKey(
            '{{%fk-movie-category_id}}',
            '{{%movie}}'
        );

        // drops index for column `category_id`
        $this->dropIndex(
            '{{%idx-movie-category_id}}',
            '{{%movie}}'
        );

        $this->dropTable('{{%movie}}');
    }
}
