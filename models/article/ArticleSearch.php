<?php

namespace app\models\article;

use app\models\article\Article;
use app\models\category\Category;
use yii\data\ActiveDataFilter;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;


class ArticleSearch extends Article
{
    public function rules()
    {
        return [
            [['title', 'description', 'content', 'user_id'], 'safe'],
        ];
    }

    public function search($params) // search for Admin Panel
    {
        $query = Article::find()->joinWith('author');
        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 5]
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
            ->andFilterWhere([ 'ilike','username' , $this->user_id]);

        return $dataProvider;
    }

    public function searchIndex($params) //search for the main page
    {
        $query = Article::find()
            ->joinWith('categories')
            ->andFilterWhere(['ilike' ,'title' , $params])
            ->orFilterWhere(['ilike', 'category_name', $params]);
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 2]
        ]);
           
        return $dataProvider;
    }

}