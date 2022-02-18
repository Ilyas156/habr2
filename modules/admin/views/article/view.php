<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\article\Article */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $articleCategories app\models\article\ArticleCategories */


$this->title = $article->title;
$this->params['breadcrumbs'] [] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>
<div>

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Update', ['update', 'article_id' => $article->article_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'article_id' => $article->article_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $article,
        'attributes' => [
            'title',
            'description',
            'content',
            ['label' => 'Category', 'value' => $article->categoriesName],
        ],
    ]) ?>


</div>

