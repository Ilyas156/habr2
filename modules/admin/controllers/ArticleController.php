<?php

namespace app\modules\admin\controllers;

use app\models\article\ArticleCategories;
use app\models\ImageUpload;
use Yii;
use app\models\article\Article;
use app\models\article\ArticleSearch;
use yii\helpers\ArrayHelper;
use app\models\category\Category;
use yii\web\Controller;
use yii\web\UploadedFile;


class ArticleController extends Controller
{

    public function actionIndex()
    {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($article_id)
    {
        $article = $this->findArticle($article_id);

        return $this->render('view', [
            'article' => $article,
        ]);
    }

    public function actionCreate() // create new article
    {
        $model = new Article();
        $uploadImage = new ImageUpload();
        //convert to an array, where key = category_id and value = category_name
        $categories = ArrayHelper::map(Category::getAll(), 'category_id', 'category_name');

        if ($this->request->isPost) 
        {
            $image = UploadedFile::getInstance($uploadImage, 'image'); // get uploaded image
            $imageName = $uploadImage->uploadImage($image); // save image on server, and get image name

            if ($model->load(Yii::$app->request->post()) && $model->createArticle($imageName)) // create new article
            {
                return $this->redirect(['view', 'article_id' => $model->article_id]);
            }
        }
        return $this->render('create', [
            'model' => $model,
            'categories' => $categories,
            'uploadImage' => $uploadImage
        ]);
    }

    public function actionUpdate($article_id) // update article
    {
        $uploadImage = new ImageUpload();
        $model = $this->findArticle($article_id);
        $categories = ArrayHelper::map(Category::getAll(), 'category_id', 'category_name');

        if ($this->request->isPost) 
        {
            $image = UploadedFile::getInstance($uploadImage, 'image');
            $image_name = $uploadImage->uploadImage($image, $model->image);

            if ($model->load($this->request->post()) && $model->updateArticle($image_name)) 
            {
                return $this->redirect(['view', 'article_id' => $model->article_id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'categories' => $categories,
            'uploadImage' => $uploadImage
        ]);
    }

    public function actionDelete($article_id)
    {
        $article = new Article();
        $article->deleteArticle($article_id);

        return $this->redirect(['index']);
    }


    protected function findArticle($article_id)
    {
        $article = new Article();
        return $article->getArticle($article_id);
    }


}