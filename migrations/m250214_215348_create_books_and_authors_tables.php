<?php

use yii\db\Migration;

class m250214_215348_create_books_and_authors_tables extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%books}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'year' => $this->integer()->notNull(),
            'description' => $this->text(),
            'isbn' => $this->string(20)->notNull(),
            'photo' => $this->string(255),
        ]);

        $this->createTable('{{%authors}}', [
            'id' => $this->primaryKey(),
            'full_name' => $this->string(255)->notNull(),
        ]);

        $this->createTable('{{%book_authors}}', [
            'book_id' => $this->integer()->notNull(),
            'author_id' => $this->integer()->notNull(),
            'PRIMARY KEY (book_id, author_id)',
        ]);

        $this->addForeignKey('fk_book_authors_book_id', '{{%book_authors}}', 'book_id', '{{%books}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_book_authors_author_id', '{{%book_authors}}', 'author_id', '{{%authors}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_book_authors_book_id', '{{%book_authors}}');
        $this->dropForeignKey('fk_book_authors_author_id', '{{%book_authors}}');
        $this->dropTable('{{%book_authors}}');
        $this->dropTable('{{%authors}}');
        $this->dropTable('{{%books}}');
    }
}
