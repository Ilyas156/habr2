<?php

namespace app\models\article;

use app\models\article\Articles;
use app\models\category\Category;
use yii\base\Model;
use yii\data\ActiveDataProvider;


class ArticlesSearch extends Articles
{
    public function rules()
    {
        return [
            [['title', 'description', 'content', 'user_id'], 'safe'],
        ];
    }

    public function search($params) // search for Admin Panel
    {
        $query = Articles::find();
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        $this->load($params);

        if (!$this->validate())
        {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'content' => $this->content,
        ]);

        $query->andFilterWhere(['ilike', 'title', $this->title])
            ->andFilterWhere(['ilike', 'description', $this->description])
            ->andFilterWhere([ 'user_id' => $this->user_id]);

        return $dataProvider;
    }

    public function searchIndex($params) //search for the main page
    {
        $articleCategories = new ArticleCategories();
        $category_id = Category::findOne(['category_name' => $params])->category_id;

        if ($category_id)
        {
            $article_id = [];
            $articleCategories = $articleCategories->findByCategoryId($category_id);

            foreach ($articleCategories as $articleCategory)
            {
                $article_id[] = $articleCategory->article_id;
            }

            return Articles::find()->where(['ilike','title', $params])
                ->orFilterWhere(['in','article_id', $article_id])
                ->all();
        }

        return Articles::find()->where(['ilike','title', $params])->all();
    }

}