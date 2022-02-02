<?php

namespace app\models\article;

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
            [['title', 'description','content', 'category_id'], 'required'],
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(),['category_id' => 'category_id'] );
    }

    public function getAuthor()
    {
        return $this->hasOne(User::className(),['user_id' => 'user_id'] );
    }

    public function createArticle()
    {
            $this->user_id = Yii::$app->user->id;
            return $this->save(false);
    }


}