<?php

use yii\db\Migration;

class m250218_220012_add_roles_for_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->getAuthManager();

        $role = $auth->getRole('ROLE_ADMIN');
        $user = \app\models\User::findOne(1); // ID пользователя admin
        $auth->assign($role, $user->id);


        $role = $auth->getRole('ROLE_USER');
        $user = \app\models\User::findOne(2); // ID пользователя admin
        $auth->assign($role, $user->id);

        $role = $auth->getRole('ROLE_GUEST');
        $user = \app\models\User::findOne(3); // ID пользователя admin
        $auth->assign($role, $user->id);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m250218_220012_add_roles_for_users cannot be reverted.\n";

        return false;
    }
}
