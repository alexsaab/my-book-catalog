<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $year integer */
/* @var $authors array */

$this->title = 'ТОП 10 авторов выпустивших больше книг за ' . $year . ' год';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="author-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $authors,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'full_name',
            'book_count',

        ],
    ]); ?>

</div>