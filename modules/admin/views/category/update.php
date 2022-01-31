<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\article\Category */

$this->title = 'Update Category';
$this->params['breadcrumbs'][] = ['label' => 'Category', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>