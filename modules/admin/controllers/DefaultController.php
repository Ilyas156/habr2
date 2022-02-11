<?php

namespace app\modules\admin\controllers;


use yii\web\Controller;
use yii\helpers\Url;


/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
    public $enableCsrfValidation = false;
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actions()
    {

        return [
            'images-get' => [
                'class' => 'vova07\imperavi\actions\GetImagesAction',
                'url' => Url::home(true) . '/images/',
                'path' => '@images/',
                // Or absolute path to directory where files are stored.
            ],
            'image-upload' => [
                'class' => 'vova07\imperavi\actions\UploadFileAction',
                'url' => '/images/',
                'path' => '@images/',
                // Or absolute path to directory where files are stored.
            ],
        ];
    }

}