<?php

namespace app\models;

use app\services\BookNotificationService;
use yii\db\ActiveRecord;

class Book extends ActiveRecord
{
    const EVENT_NEW_BOOK_ADDED = 'newBookAdded';

    public $author_full_name;
    public static function tableName()
    {
        return 'books';
    }

    public function rules()
    {
        return [
            [['title', 'year', 'description', 'isbn', 'photo'], 'filter', 'filter' => 'trim'],
            [['title', 'year', 'description', 'isbn', 'photo'], 'required'],
            [['title', 'photo'], 'string', 'min' => 2, 'max' => 255],
            [['year'], 'string', 'min' => 4, 'max' => 4],
            [['isbn'], 'string', 'min' => 4, 'max' => 40],
        ];
    }

    public function getAuthor()
    {
        return $this->hasOne(Author::className(), ['id' => 'author_id'])->viaTable('book_authors', ['book_id' => 'id']);
    }

    public function afterInsert($insert, $changedAttributes)
    {
        parent::afterInsert($insert, $changedAttributes);

        // Отправляем уведомление подписавшимся пользователем
        $this->trigger(Book::EVENT_NEW_BOOK_ADDED, new BookEvent(['book' => $this]));

        // Привязываем сервисный класс к событию
        $notificationService = new BookNotificationService();
        $this->on(Book::EVENT_NEW_BOOK_ADDED, [$notificationService, 'sendNotification']);
    }
}