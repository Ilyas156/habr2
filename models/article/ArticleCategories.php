<?php

namespace app\models\article;

use Yii;
use yii\db\ActiveRecord;


class ArticleCategories extends ActiveRecord
{

    public static function tableName()
    {
        return 'article_category';
    }

    public function rules()
    {
        return [
            [[ 'category_id', 'article_id'], 'required']
        ];
    }

}