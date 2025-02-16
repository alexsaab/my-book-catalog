<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Book;

class BookController extends Controller
{
    public function actionIndex()
    {
        $books = Book::find()->all();
        return $this->render('index', ['books' => $books]);
    }

    public function actionView($id)
    {
        $book = Book::findOne($id);
        return $this->render('view', ['book' => $book]);
    }

    public function actionCreate()
    {
        $book = new Book();
        if ($book->load(Yii::$app->request->post()) && $book->save()) {
            return $this->redirect(['view', 'id' => $book->id]);
        }
        return $this->render('create', ['book' => $book]);
    }

    public function actionUpdate($id)
    {
        $book = Book::findOne($id);
        if ($book->load(Yii::$app->request->post()) && $book->save()) {
            return $this->redirect(['view', 'id' => $book->id]);
        }
        return $this->render('update', ['book' => $book]);
    }

    public function actionDelete($id)
    {
        Book::findOne($id)->delete();
        return $this->redirect(['index']);
    }
}