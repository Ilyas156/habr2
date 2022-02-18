<?php

namespace app\models\article;


use Yii;
use yii\db\ActiveRecord;


class ArticleViews extends ActiveRecord
{
    public static function tableName()
    {
        return 'article_view';
    }

    public function rules()
    {
        return [
            [[ 'user_id', 'article_id'], 'required']
        ];
    }

    public function setViews($article_id) // add views
    {

        if(!($this->checkViews($article_id))) // if the user has not yet Viewed this article, then add
        {

            $this->user_id = $this->getUser();
            $this->article_id = $article_id;
            $this->save();
        }
    }

    // checks if the user viewed the article
    private function checkViews($article_id)
    {
        return ArticleViews::findOne(['user_id' => $this->getUser(), 'article_id' => $article_id]);
    }
    // return current user id
    private function getUser()
    {
        return Yii::$app->user->id;
    }

}