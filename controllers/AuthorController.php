<?php

namespace app\controllers;

use Yii;
use app\models\search\AuthorSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use app\models\Author;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

class AuthorController extends Controller
{

    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            if (!\Yii::$app->user->can('author/'. $action->id)) {
                throw new ForbiddenHttpException('Access denied');
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * Lists all Author models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AuthorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // Добавляем подсчет количества книг для каждого автора
        foreach ($dataProvider->models as $key=>$author) {
            $author->book_count = count($author->books);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Author model.
     * @param int $id
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Author model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Author();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Author model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);


        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Author model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionSubscribe($id)
    {
        $this->findModel($id)->subscribe(Yii::app()->user->getId());

        return $this->redirect(['index']);
    }


    public function actionUnsubscribe($id)
    {
        $this->findModel($id)->unSubscribe(Yii::app()->user->getId());

        return $this->redirect(['index']);
    }

    /**
     * Finds the Author model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return Author the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Author::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Report top authors by year
     * @param $year
     * @return string
     */
    public function actionTopAuthorsByYear($year)
    {
        $query = Author::find()
            ->select('authors.id, authors.full_name, COUNT(books.id) as book_count')
            ->joinWith('books')
            ->where(['books.year' => $year])
            ->groupBy('authors.id')
            ->orderBy('book_count DESC')
            ->limit(10);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('top-authors-by-year', [
            'year' => $year,
            'authors' => $dataProvider,
        ]);
    }
}