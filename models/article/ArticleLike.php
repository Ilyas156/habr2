<?php

namespace app\models\article;


use Yii;
use yii\db\ActiveRecord;


class ArticleLike extends ActiveRecord
{
    public static function tableName()
    {
        return 'article_like';
    }
    public function rules()
    {
        return [
            [[ 'user_id', 'article_id'], 'required']
        ];
    }

    public function setLikes($article_id) // add Like
    {
        if(!($this->checkLike($article_id))) // if the user has not yet Liked this article, then add
        {
            $this->user_id = Yii::$app->user->id;
            $this->article_id = $article_id;
            $this->save();
        } else { // otherwise, remove Like
            ArticleLike::findOne(['user_id' => Yii::$app->user->id, 'article_id' => $article_id])->delete();
        }

    }
    // checks if the user liked the article
    public static function checkLike($article_id) : int
    {
        return (boolean) ArticleLike::findOne(['user_id' => Yii::$app->user->id, 'article_id' => $article_id]);
    }
}