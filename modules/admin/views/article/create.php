<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\article\Articles */
/* @var $categories app\models\category\Category */
/* @var $articleCategories app\models\article\ArticleCategories */
/* @var $uploadImage app\models\ImageUpload */

$this->title = 'Create Article';
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'categories' => $categories,
        'articleCategories' => $articleCategories,
        'uploadImage' => $uploadImage
    ]) ?>

</div>