<?php

use yii\db\Migration;

class m250216_095532_insert_data_into_authors_and_books_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $authors = [
            ['full_name' => 'Иван Иванов'],
            ['full_name' => 'Петр Петров'],
            ['full_name' => 'Сергей Сергеев'],
            ['full_name' => 'Александр Александров'],
        ];

        $books = [
            ['title' => 'Книга 1', 'year' => 2020, 'description' => 'Описание книги 1', 'isbn' => '1234567890', 'photo' => 'https://example.com/book1.jpg'],
            ['title' => 'Книга 2', 'year' => 2021, 'description' => 'Описание книги 2', 'isbn' => '2345678901', 'photo' => 'https://example.com/book2.jpg'],
            ['title' => 'Книга 3', 'year' => 2022, 'description' => 'Описание книги 3', 'isbn' => '3456789012', 'photo' => 'https://example.com/book3.jpg'],
            ['title' => 'Книга 4', 'year' => 2023, 'description' => 'Описание книги 4', 'isbn' => '4567890123', 'photo' => 'https://example.com/book4.jpg'],
            ['title' => 'Книга 5', 'year' => 2024, 'description' => 'Описание книги 5', 'isbn' => '5678901234', 'photo' => 'https://example.com/book5.jpg'],
            ['title' => 'Книга 6', 'year' => 2020, 'description' => 'Описание книги 6', 'isbn' => '6789012345', 'photo' => 'https://example.com/book6.jpg'],
            ['title' => 'Книга 7', 'year' => 2021, 'description' => 'Описание книги 7', 'isbn' => '7890123456', 'photo' => 'https://example.com/book7.jpg'],
            ['title' => 'Книга 8', 'year' => 2022, 'description' => 'Описание книги 8', 'isbn' => '8901234567', 'photo' => 'https://example.com/book8.jpg'],
            ['title' => 'Книга 9', 'year' => 2023, 'description' => 'Описание книги 9', 'isbn' => '9012345678', 'photo' => 'https://example.com/book9.jpg'],
            ['title' => 'Книга 10', 'year' => 2024, 'description' => 'Описание книги 10', 'isbn' => '0123456789', 'photo' => 'https://example.com/book10.jpg'],
            ['title' => 'Книга 11', 'year' => 2020, 'description' => 'Описание книги 11', 'isbn' => '1234567890', 'photo' => 'https://example.com/book11.jpg'],
            ['title' => 'Книга 12', 'year' => 2021, 'description' => 'Описание книги 12', 'isbn' => '2345678901', 'photo' => 'https://example.com/book12.jpg'],
            ['title' => 'Книга 13', 'year' => 2022, 'description' => 'Описание книги 13', 'isbn' => '3456789012', 'photo' => 'https://example.com/book13.jpg'],
            ['title' => 'Книга 14', 'year' => 2023, 'description' => 'Описание книги 14', 'isbn' => '4567890123', 'photo' => 'https://example.com/book14.jpg'],
        ];

        $bookAuthors = [
            ['book_id' => 1, 'author_id' => 1],
            ['book_id' => 2, 'author_id' => 2],
            ['book_id' => 3, 'author_id' => 3],
            ['book_id' => 4, 'author_id' => 4],
            ['book_id' => 5, 'author_id' => 1],
            ['book_id' => 6, 'author_id' => 2],
            ['book_id' => 7, 'author_id' => 3],
            ['book_id' => 8, 'author_id' => 4],
            ['book_id' => 9, 'author_id' => 1],
            ['book_id' => 10, 'author_id' => 2],
            ['book_id' => 11, 'author_id' => 3],
            ['book_id' => 12, 'author_id' => 4],
            ['book_id' => 13, 'author_id' => 1],
            ['book_id' => 14, 'author_id' => 2],
        ];

        $this->batchInsert('{{%authors}}',['full_name'], array_values($authors));
        $this->batchInsert('{{%books}}', ['title', 'year', 'description', 'isbn', 'photo'], array_values($books));
        $this->batchInsert('{{%book_authors}}', ['book_id', 'author_id'], array_values($bookAuthors));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m250216_095532_insert_data_into_authors_and_books_tables cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250216_095532_insert_data_into_authors_and_books_tables cannot be reverted.\n";

        return false;
    }
    */
}
