<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\category\Category */

$this->title = 'Create Category';
$this->params['breadcrumbs'][] = ['label' => 'Category', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>