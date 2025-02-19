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
            'password_hash' => Yii::$app->security->generatePasswordHash('admin'),
            'email' => 'cRgZP@example.com',
            'phone' => '+79123456789',
            'auth_key' => Yii::$app->security->generateRandomString(),
            'status' => User::STATUS_ACTIVE,
            'role' => User::ROLE_ADMIN,
            'created_at' => time(),
            'updated_at' => time()
        ]);

        $this->insert('{{%user}}', [
            'username' => 'user',
            'password_hash' =>  Yii::$app->security->generatePasswordHash('user'),
            'email' => 'Oo8gK@example.com',
            'phone' => '+79123456733',
            'auth_key' => Yii::$app->security->generateRandomString(),
            'status' => User::STATUS_ACTIVE,
            'role' => User::ROLE_USER,
            'created_at' => time(),
            'updated_at' => time()
        ]);

        $this->insert('{{%user}}', [
            'username' => 'guest',
            'password_hash' =>  Yii::$app->security->generatePasswordHash('guest'),
            'email' => 'Oo821e@example.com',
            'phone' => '+79123456756',
            'auth_key' => Yii::$app->security->generateRandomString(),
            'status' => User::STATUS_ACTIVE,
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
