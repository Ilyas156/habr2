<?php

namespace app\models\article;


use Yii;
use yii\db\ActiveRecord;


class ArticleLikes extends ActiveRecord
{
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
            ArticleLikes::findOne(['user_id' => Yii::$app->user->id, 'article_id' => $article_id])->delete();
        }

    }
    // returns the number of Likes for an article
    public function countLikes($article_id)
    {
        $likes = ArticleLikes::find()->where(['article_id' => $article_id]);
        return $likes->count();
    }
    // checks if the user liked the article
    public static function checkLike($article_id)
    {
        return (boolean) ArticleLikes::findOne(['user_id' => Yii::$app->user->id, 'article_id' => $article_id]);
    }
}