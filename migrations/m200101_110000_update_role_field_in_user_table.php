<?php

use yii\db\Migration;

class m200101_110000_update_role_field_in_user_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'role', $this->integer()->notNull()->defaultValue(10));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'role');
    }
}