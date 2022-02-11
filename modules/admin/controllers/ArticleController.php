<?php

namespace app\modules\admin\controllers;

use app\models\article\ArticleCategories;
use app\models\ImageUpload;
use Yii;
use app\models\article\Articles;
use app\models\article\ArticlesSearch;
use yii\helpers\ArrayHelper;
use app\models\category\Category;
use yii\web\Controller;
use yii\web\UploadedFile;


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
        $articleCategories = new ArticleCategories();
        return $this->render('view', [
            'articles' => $this->findArticle($article_id),
            'articleCategories' => $articleCategories
        ]);
    }

    public function actionCreate() // create new article
    {
        $model = new Articles();
        $articleCategories = new ArticleCategories();
        $uploadImage = new ImageUpload();
        //convert to an array, where key = category_id and value = category_name
        $categories = ArrayHelper::map(Category::getAll(), 'category_id', 'category_name');

        if ($this->request->isPost) {

            $post = $this->request->post();
            $category_id = $post['ArticleCategories']['category_id']; // get selected categories
            $image = UploadedFile::getInstance($uploadImage, 'image'); // get uploaded image
            $imageName = $uploadImage->uploadImage($image); // save image on server, and get image name

            if ($model->load($post) && $model->createArticle($imageName)) // create new article
            {
                if ($articleCategories->addCategories($category_id, $model->article_id)) // adds article categories
                {
                    return $this->redirect(['view', 'article_id' => $model->article_id]);
                }
            }
        }
        return $this->render('create', [
            'model' => $model,
            'categories' => $categories,
            'articleCategories' => $articleCategories,
            'uploadImage' => $uploadImage
        ]);
    }

    public function actionUpdate($article_id) // update article
    {
        $articleCategories = new ArticleCategories();
        $uploadImage = new ImageUpload();
        $model = $this->findArticle($article_id);
        $categories = ArrayHelper::map(Category::getAll(), 'category_id', 'category_name');

        if ($this->request->isPost) {
            $post = $this->request->post();
            $category_id = $post['ArticleCategories']['category_id'];
            //the same as in "create" , but now we also pass the current image
            $image = UploadedFile::getInstance($uploadImage, 'image');
            $image_name = $uploadImage->uploadImage($image, $model->image);
            if ($model->load($post)) {
                if ($model->updateArticle($image_name) && // update this article
                    // update categories for this article
                    $articleCategories->updateCategories($category_id,$article_id)) {
                    return $this->redirect(['view', 'article_id' => $model->article_id]);
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
            'categories' => $categories,
            'articleCategories' => $articleCategories,
            'uploadImage' => $uploadImage
        ]);
    }

    public function actionDelete($article_id)
    {
        $articleCategory = new ArticleCategories();
        $articleCategory->deleteArticleCategories($article_id);

        $article = new Articles();
        $article->deleteArticle($article_id);

        return $this->redirect(['index']);
    }


    protected function findArticle($article_id)
    {
        $article = new Articles();
        return $article->getArticle($article_id);
    }


}