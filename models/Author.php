<?php

namespace app\models;

use yii\db\ActiveRecord;

class Author extends ActiveRecord
{
    public $book_count;

    public static function tableName()
    {
        return 'authors';
    }

    public function getBooks()
    {
        return $this->hasMany(Book::className(), ['id' => 'book_id'])->viaTable('book_authors', ['author_id' => 'id']);
    }
}