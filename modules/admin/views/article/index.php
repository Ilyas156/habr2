<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\grid\DataColumn;

/* @var $this yii\web\View */
/* @var $searchModel app\models\article\ArticlesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $search app\models\article\CategorySearch */


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
                    'attribute' => 'category_id',
                    'label' => 'Category',
                    'value' => function($data)
                    {
                        return $data->category->category_name;
                    },
            ],
            [
                'attribute' => 'user_id',
                'label' => 'Author',
                'value' => function($data)
                {
                    return $data->author->username;
                },
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, app\models\article\Articles $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'article_id' => $model->article_id]);
                }
            ],
        ],
    ]); ?>

    

</div>