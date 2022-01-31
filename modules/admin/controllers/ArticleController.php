<?php

namespace app\modules\admin\controllers;

use app\models\article\Articles;
use app\models\article\ArticlesSearch;
use yii\helpers\ArrayHelper;
use app\models\article\Category;
use yii\web\Controller;


class ArticleController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new ArticlesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionView($article_id)
    {
        return $this->render('view', [
            'articles' => $this->findArticle($article_id),
        ]);
    }
    public function actionCreate()
    {
        $model = new Articles();
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'article_id' => $model->article_id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionDelete($article_id)
    {
        $this->findArticle($article_id)->delete();

        return $this->redirect(['index']);
    }

    public function actionUpdate($article_id)
    {
        $model = $this->findArticle($article_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'article_id' => $model->article_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    protected function findArticle($article_id) {
        return Articles::findOne(['article_id' => $article_id]);
    }
}