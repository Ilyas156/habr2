<?php

namespace app\models\article;

use yii\db\ActiveRecord;
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

    public function getCategory()
    {
        return $this->hasOne(Category::className(),['category_id' => 'category_id'] );
    }


}