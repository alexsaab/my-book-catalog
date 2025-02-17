<?php

namespace app\models;

use yii\db\ActiveRecord;

class Book extends ActiveRecord
{
    public static function tableName()
    {
        return 'books';
    }

    public function getAuthor()
    {
        return $this->hasOne(Author::className(), ['id' => 'author_id'])->viaTable('book_authors', ['book_id' => 'id']);
    }
}