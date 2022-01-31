<?php

namespace app\modules\admin\controllers;

use app\models\article\Category;
use app\models\article\CategorySearch;
use yii\web\Controller;


class CategoryController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new Category();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionDelete($category_id)
    {
        $this->findCategory($category_id)->delete();

        return $this->redirect(['index']);
    }

    public function actionUpdate($category_id)
    {
        $model = $this->findCategory($category_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    protected function findCategory($category_id) {
        return Category::findOne(['category_id' => $category_id]);
    }
}