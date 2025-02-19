<?php

namespace app\models;

use yii\db\ActiveRecord;

class Author extends ActiveRecord
{
    public $book_count;
    /**
     * @var mixed|null
     */
    public $users;

    public $connection;



    public static function tableName()
    {
        return 'authors';
    }

    public function rules()
    {
        return [
            ['full_name', 'filter', 'filter' => 'trim'],
            [['full_name'], 'required'],
            ['full_name', 'string', 'min' => 2, 'max' => 255],
        ];
    }

    public function getBooks()
    {
        return $this->hasMany(Book::className(), ['id' => 'book_id'])->viaTable('book_authors', ['author_id' => 'id']);
    }

    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('user_authors', ['author_id' => 'id']);
    }

    public function subscribe($user_id)
    {
        $connection = \Yii::$app->db;
        $this->users->add($user_id);
    }


    public function unSubscribe($user_id)
    {
        $this->users->delete($user_id);
    }
}