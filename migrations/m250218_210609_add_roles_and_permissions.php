<?php

use yii\db\Migration;

class m250218_210609_add_roles_and_permissions extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        // Создание ролей
        $roleUser = $auth->createRole('ROLE_USER');
        $roleGuest = $auth->createRole('ROLE_GUEST');
        $roleAdmin = $auth->createRole('ROLE_ADMIN');

        // Назначение ролей
        $auth->add($roleUser);
        $auth->add($roleGuest);
        $auth->add($roleAdmin);

        // Создание разрешений
        $authorIndex = $auth->createPermission('author/index');
        $authorView = $auth->createPermission('author/view');
        $authorCreate = $auth->createPermission('author/create');
        $authorUpdate = $auth->createPermission('author/update');
        $authorDelete = $auth->createPermission('author/delete');
        $authorSubscribe = $auth->createPermission('author/subscribe');
        $authorUnsubscribe = $auth->createPermission('author/unsubscribe');

        $bookIndex = $auth->createPermission('book/index');
        $bookView = $auth->createPermission('book/view');
        $bookCreate = $auth->createPermission('book/create');
        $bookUpdate = $auth->createPermission('book/update');
        $bookDelete = $auth->createPermission('book/delete');

        // Назначение разрешений
        $auth->add($authorIndex);
        $auth->add($authorView);
        $auth->add($authorCreate);
        $auth->add($authorUpdate);
        $auth->add($authorDelete);
        $auth->add($authorSubscribe);
        $auth->add($authorUnsubscribe);

        $auth->add($bookIndex);
        $auth->add($bookView);
        $auth->add($bookCreate);
        $auth->add($bookUpdate);
        $auth->add($bookDelete);

        // Назначение разрешений ролям
        $auth->addChild($roleUser, $authorIndex);
        $auth->addChild($roleUser, $authorView);
        $auth->addChild($roleUser, $authorCreate);
        $auth->addChild($roleUser, $authorUpdate);
        $auth->addChild($roleUser, $authorDelete);

        $auth->addChild($roleUser, $bookIndex);
        $auth->addChild($roleUser, $bookView);
        $auth->addChild($roleUser, $bookCreate);
        $auth->addChild($roleUser, $bookUpdate);
        $auth->addChild($roleUser, $bookDelete);

        $auth->addChild($roleGuest, $authorIndex);
        $auth->addChild($roleGuest, $authorView);
        $auth->addChild($roleGuest, $authorSubscribe);
        $auth->addChild($roleGuest, $authorUnsubscribe);

        $auth->addChild($roleGuest, $bookIndex);
        $auth->addChild($roleGuest, $bookView);

        $auth->addChild($roleAdmin, $authorIndex);
        $auth->addChild($roleAdmin, $authorView);
        $auth->addChild($roleAdmin, $authorCreate);
        $auth->addChild($roleAdmin, $authorUpdate);
        $auth->addChild($roleAdmin, $authorDelete);
        $auth->addChild($roleAdmin, $authorSubscribe);
        $auth->addChild($roleAdmin, $authorUnsubscribe);

        $auth->addChild($roleAdmin, $bookIndex);
        $auth->addChild($roleAdmin, $bookView);
        $auth->addChild($roleAdmin, $bookCreate);
        $auth->addChild($roleAdmin, $bookUpdate);
        $auth->addChild($roleAdmin, $bookDelete);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;

        // Удаление разрешений
        $auth->remove($auth->getPermission('author/index'));
        $auth->remove($auth->getPermission('author/view'));
        $auth->remove($auth->getPermission('author/create'));
        $auth->remove($auth->getPermission('author/update'));
        $auth->remove($auth->getPermission('author/delete'));
        $auth->remove($auth->getPermission('author/subscribe'));
        $auth->remove($auth->getPermission('author/unsubscribe'));

        $auth->remove($auth->getPermission('book/index'));
        $auth->remove($auth->getPermission('book/view'));
        $auth->remove($auth->getPermission('book/create'));
        $auth->remove($auth->getPermission('book/update'));
        $auth->remove($auth->getPermission('book/delete'));

        // Удаление ролей
        $auth->remove($auth->getRole('ROLE_USER'));
        $auth->remove($auth->getRole('ROLE_GUEST'));
        $auth->remove($auth->getRole('ROLE_ADMIN'));
    }
}
