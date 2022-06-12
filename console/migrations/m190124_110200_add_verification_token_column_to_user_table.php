<?php

use \yii\db\Migration;

class m190124_110200_add_verification_token_column_to_user_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user}}', 'verification_token', $this->string()->defaultValue(null));
    }

    public function down()
    {
        $this->dropColumn('{{%user}}', 'verification_token');
    }
}
/*
php yii migrate/create create_organization_rez_table --fields="organization_id:string(16):notNull:foreignKey(organization),
user_id:integer(11):notNull:foreignKey(user),created_at:integer(11)"

php yii migrate/create create_movie_theater_table --fields="id:" 
*/