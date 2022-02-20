<?php

namespace app\models\category;

use app\models\article\Article;
use yii\db\ActiveRecord;
use Yii;

class Category extends ActiveRecord
{

    public static function tableName()
    {
        return 'category';
    }

    public function rules()
    {
        return [
            [['category_name'], 'required'],
            [['category_name'], 'unique'],
        ];
    }
    // return all categories
    public static function getAll()
    {
        return Category::find()->all();
    }

    public function getArticles()
    {
        return $this->hasMany(Article::className(), ['article_id' => 'article_id'] )
            ->viaTable('article_category', ['category_id' => 'category_id']);
    }

    public function getCategory($category_id)
    {
        return Category::findOne(['category_id' => $category_id]);
    }

    public function deleteCategory($category_id)
    {
        return $this->getCategory($category_id)->delete();
    }

}
