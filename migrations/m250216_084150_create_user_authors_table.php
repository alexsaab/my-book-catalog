<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_authors}}`.
 */
class m250216_084150_create_user_authors_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_authors}}', [
            'user_id' => $this->integer()->notNull(),
            'author_id' => $this->integer()->notNull(),
            'subscribe_at' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey('fk_user_authors_user_id', '{{%user_authors}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_user_authors_author_id', '{{%user_authors}}', 'author_id', '{{%authors}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_authors}}');
    }
}
