<?php

namespace app\services;

use app\models\Author;
use app\models\Book;
use app\models\BookEvent;
use app\models\User;
use app\services\SmsPilotService;

class BookNotificationService
{
    public function sendNotification(BookEvent $event)
    {
        $book = $event->book;
        $author = $book->author;

        // Получаем список подписавшихся пользователей
        $users = Author::find()->andWhere(['id' => $author->id])->users()->all();

        foreach ($users as $user) {
            // Отправляем уведомление пользователю
            $smsService = new SmsPilotService();
            $smsService->send($user->phone, 'Новая книга добавлена: ' . $book->title);
        }
    }
}