<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel app\models\article\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'Articles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div>

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Article', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title',
            'description',
            [
                'attribute' => 'user_id',
                'label' => 'Author',
                'value' => 'author.username'
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, app\models\article\Article $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'article_id' => $model->article_id]);
                }
            ],
        ],
    ]); ?>


</div>
