<?php

namespace app\modules\admin;
use Yii;
use yii\filters\AccessControl;

/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $layout = '/admin';

    public $controllerNamespace = 'app\modules\admin\controllers';

    public function behaviors()
    {
        return [
            'access' =>  [
                'class' =>  AccessControl::className(),
                'denyCallback'  =>  function($rule, $action)
                {
                    throw new \yii\web\NotFoundHttpException();
                },
                'rules' =>  [
                    [
                        'allow' =>  true,
                        'roles' => ['admin']
                    ]
                ]
            ]
        ];
    }

    public function init()
    {
        parent::init();
        \Yii::$app->setLayoutPath('@app/modules/admin/views/layouts');
        \Yii::$app->layout = 'admin';
    }

}