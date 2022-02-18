<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use vova07\imperavi\Widget;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model app\models\article\Article */
/* @var $articleCategories app\models\article\ArticleCategories */
/* @var $uploadImage app\models\ImageUpload */
/* @var $form yii\widgets\ActiveForm */


?>

<div>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput() ?>

    <?= $form->field($uploadImage, 'image')->label('Главное изображение')->fileInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'content')
        ->widget(Widget::className(), [ 'settings' => [
            'minHeight' => 500,
            'plugins' => [
                    'clips',
                    'fullscreen',
                    'imagemanager',
            ],
            'imageUpload' => Url::to(['default/image-upload']),
            'imageManagerJson' => Url::to(['default/images-get'])
            ]])
        ?>

    <?= $form->field($model, 'article_categories')->label('Category')
        ->widget(Select2::classname(), [
            'data' => $categories,
            'options' => ['placeholder' => 'Выберите категорию', 'multiple' => 'true'],
            'pluginOptions' => [
                'allowClear' => true,
                'tags' => true,
                'maximumInputLength' => 10
            ],
        ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>