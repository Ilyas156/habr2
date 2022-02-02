<?php

namespace app\models\article;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\article\Articles;
use yii\data\ArrayDataProvider;

class ArticlesSearch extends Articles
{
    public function rules()
    {
        return [
            [['title', 'description', 'content', 'category_id', 'user_id'], 'safe']
        ];
    }

    public function search($params)
    {
        $query = Articles::find();
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        $this->load($params);

        if (!$this->validate()) {
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
            ->andFilterWhere([ 'category_id' => $this->category_id])
            ->andFilterWhere([ 'user_id' => $this->user_id]);

        return $dataProvider;
    }
}