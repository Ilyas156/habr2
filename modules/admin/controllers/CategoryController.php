<?php

namespace app\modules\admin\controllers;

use app\models\article\ArticleCategories;
use app\models\category\Category;
use app\models\category\CategorySearch;
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

    public function actionCreate() // create new category
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

    public function actionDelete($category_id) // delete category
    {

        $category = new Category();
        $category->deleteCategory($category_id);

        return $this->redirect(['index']);
    }

    public function actionUpdate($category_id) // update category
    {
        $model = $this->findCategory($category_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    protected function findCategory($category_id)
    {
        $category = new Category();
        return $category->getCategory($category_id);
    }
}