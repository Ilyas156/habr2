<?php

namespace app\models\article;


use app\models\category\Category;
use Yii;
use yii\db\ActiveRecord;


class ArticleCategories extends ActiveRecord
{
    public function rules()
    {
        return [
            [[ 'category_id', 'article_id'], 'required']
        ];
    }

    // adds categories to the article
    public function addCategories($category_id, $article_id)
    {
        if ($category_id)
        {
            foreach ($category_id as $id)
            {
                $articleCategories = new ArticleCategories();
                $articleCategories->article_id = $article_id;
                $articleCategories->category_id = $id;
                $articleCategories->save();
            }
            return true;
        }
        return false;
    }

    //updates the category of the article
    public function updateCategories($category_id, $article_id)
    {
        $this->deleteArticleCategories($article_id); // delete "old" categories

        return $this->addCategories($category_id, $article_id); // add "new" categories

    }
    // find articles selected category
    public function getArticlesByCategory($id)
    {
        $articles_categories = $this->findByCategoryId($id);
        $articles = [];
        foreach ($articles_categories as $articles_category)
        {
            $articles[] = Articles::findOne(['article_id' => $articles_category->article_id]);
        }
        return $articles;
    }

    public function getArticleCategories($article_id)
    {
        $article_categories = $this->findByArticleId($article_id);
        $categoryName = [];
        foreach ($article_categories as $article_category)
        {
            $category = Category::findOne(['category_id' => $article_category->category_id]);
            $categoryName[] = $category->category_name;
        }
        return implode(', ',$categoryName); // join as string
    }

    public function findByCategoryId($category_id)
    {
        return ArticleCategories::find()->where(['category_id' => $category_id])->all();
    }

    public function findByArticleId($article_id)
    {
        return ArticleCategories::find()->where(['article_id' => $article_id])->all();
    }
    // delete all categories from the article
    public function deleteArticleCategories($article_id)
    {
        return Yii::$app->db->createCommand()
            ->delete('article_categories', ['article_id' => $article_id])->execute();
    }
    // delete one category from the article
    public function deleteArticleCategory($category_id)
    {
        return Yii::$app->db->createCommand()
            ->delete('article_categories', ['category_id' => $category_id])->execute();
    }




}