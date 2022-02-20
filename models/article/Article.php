<?php

namespace app\models\article;

use app\models\category\Category;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use app\models\User;
use yii\helpers\ArrayHelper;

use Yii;

class Article extends ActiveRecord
{

    public $article_categories;

    public static function tableName()
    {
        return 'article';
    }

    public function rules()
    {
        return [
            [['title', 'description','content'], 'required'],
            [['article_categories'], 'safe']
        ];
    }

    //returns all articles
    public static function getAll()
    {
        return Article::find()->all();
    }

    //return a specific article
    public static function getArticle($id)
    {
        return Article::findOne(['article_id' => $id]);
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

    public function createArticle($image_name) : bool
    {
        $this->user_id = Yii::$app->user->id;
        $this->image = $image_name;
        

        return $this->save();
    }

    // find article categories
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['category_id' => 'category_id'] )
            ->viaTable('article_category', ['article_id' => 'article_id']);
    }

    public function getCategoriesName() : string
    {
        $categories = $this->getCategories()->all();
        $category_name = [];

        foreach ($categories as $category)
        {
            $category_name[] = $category['category_name'];
        }
        return implode(', ', $category_name);
    }

    public function updateArticle($image_name) : bool
    {
        $this->image = $image_name;

        return $this->save(false);
    }


    public function deleteArticle($article_id)
    {
        $this->getArticle($article_id)->delete();
    }

    // Get the number of views for an article
    public function getViews() : int
    {
        return $this->hasMany(ArticleViews::className(), ['article_id' => 'article_id'])
            ->count();
    }
    // Get the number of likes for an article
    public function getLikes() : int
    {
        return $this->hasMany(ArticleLike::className(), ['article_id' => 'article_id'])
            ->count();
    }
    //checks if the user liked the article
    public function getCheckLike()
    {
        return $this->hasOne(ArticleLike::className(), ['article_id' => 'article_id',
            'user_id' => 'user_id']);
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        $oldCategories = ArrayHelper::map($this->categories, 'category_name', 'category_id');
        $categoriesToInsert = array_diff($this->article_categories, $oldCategories );
        $categoriesToDelete = array_diff($oldCategories , $this->article_categories);

        foreach ($categoriesToInsert as $category)
        {
            $articleCategories = new ArticleCategories();
            $articleCategories->article_id = $this->article_id;
            $articleCategories->category_id = $category;
            $articleCategories->save();
        }

        ArticleCategories::deleteAll(['category_id' => $categoriesToDelete, 
                        'article_id' => $this->article_id]);

    }

    public function afterFind()
    {
        parent::afterFind();
        $this->article_categories = $this->categories;
    }

}