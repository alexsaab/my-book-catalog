<?php

use yii\db\Migration;
use app\models\User;

class m250216_081355_add_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('{{%user}}', [
            'username' => 'admin',
            'password_hash' =>  hash('sha256','admin'),
            'email' => 'cRgZP@example.com',
            'auth_key' => 'test1key',
            'status' => 1,
            'role' => User::ROLE_ADMIN,
            'created_at' => time(),
            'updated_at' => time()
        ]);

        $this->insert('{{%user}}', [
            'username' => 'user',
            'password_hash' =>  hash('sha256','user'),
            'email' => 'Oo8gK@example.com',
            'auth_key' => 'test2key',
            'status' => 1,
            'role' => User::ROLE_USER,
            'created_at' => time(),
            'updated_at' => time()
        ]);

        $this->insert('{{%user}}', [
            'username' => 'guest',
            'password_hash' =>  hash('sha256','guest'),
            'email' => 'Oo821e@example.com',
            'auth_key' => 'test3key',
            'status' => 1,
            'role' => User::ROLE_GUEST,
            'created_at' => time(),
            'updated_at' => time()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m250216_081355_add_users cannot be reverted.\n";

        return false;
    }
}
