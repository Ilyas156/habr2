<?php

namespace app\models\article;

use app\models\category\Category;
use yii\db\ActiveRecord;
use app\models\User;

use Yii;

class Articles extends ActiveRecord
{

    public static function tableName()
    {
        return 'articles';
    }

    public function rules()
    {
        return [
            [['title', 'description','content'], 'required'],
        ];
    }

    //returns all articles
    public static function getAll()
    {
        return Articles::find()->all();
    }

    //return a specific article
    public static function getArticle($id) {
        return Articles::findOne(['article_id' => $id]);
    }

    //return article Author
    public function getAuthor()
    {
        return $this->hasOne(User::className(),['user_id' => 'user_id'] );
    }
    // article main image
    public function getImage()
    {
        return ($this->image) ? '/images/' . $this->image : '/images/kotik.jpg';
    }

    public function createArticle($image_name)
    {
        $this->user_id = Yii::$app->user->id;
        $this->image = $image_name;

        return $this->save(false);
    }
    // find article categories
    public function getCategory($id)
    {
        $articleCategories = new ArticleCategories();
        return $articleCategories->getArticleCategories($id);
    }

    public function updateArticle($image_name)
    {
        $this->image = $image_name;

        return $this->save(false);
    }


    public function deleteArticle($article_id)
    {
        $this->getArticle($article_id)->delete();
    }

    // Get the number of views for an article
    public function getViews($article_id)
    {
        $views = new ArticleViews();
        return $views->countViews($article_id);
    }
    // Get the number of likes for an article
    public function getLikes($article_id)
    {
        $likes = new ArticleLikes();
        return $likes->countLikes($article_id);
    }
    //checks if the user liked the article
    public function checkLike($article_id)
    {
        return ArticleLikes::checkLike($article_id);
    }


}