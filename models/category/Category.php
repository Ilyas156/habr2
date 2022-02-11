<?php

namespace app\models\category;

use app\models\article\ArticleCategories;
use app\models\article\Articles;
use yii\db\ActiveRecord;
use Yii;

class Category extends ActiveRecord
{

    public static function tableName()
    {
        return 'categories';
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
    // return a specific category
    public function getCategory($category_id)
    {
        return Category::findOne(['category_id' => $category_id]);
    }

    public function deleteCategory($category_id)
    {
        return $this->getCategory($category_id)->delete();
    }

}