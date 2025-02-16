<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Author;

class AuthorController extends Controller
{
    public function actionIndex()
    {
        $authors = Author::find()->all();
        return $this->render('index', ['authors' => $authors]);
    }

    public function actionView($id)
    {
        $author = Author::findOne($id);
        return $this->render('view', ['author' => $author]);
    }

    public function actionCreate()
    {
        $author = new Author();
        if ($author->load(Yii::$app->request->post()) && $author->save()) {
            return $this->redirect(['view', 'id' => $author->id]);
        }
        return $this->render('create', ['author' => $author]);
    }

    public function actionUpdate($id)
    {
        $author = Author::findOne($id);
        if ($author->load(Yii::$app->request->post()) && $author->save()) {
            return $this->redirect(['view', 'id' => $author->id]);
        }
        return $this->render('update', ['author' => $author]);
    }

    public function actionDelete($id)
    {
        Author::findOne($id)->delete();
        return $this->redirect(['index']);
    }
}