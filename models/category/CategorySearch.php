<?php

namespace app\models\category;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\category\Category;

class CategorySearch extends Category
{
    public function rules()
    {
        return [
            [['category_name'], 'safe']
        ];
    }

    public function search($params)
    {
        $query = Category::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere(['ilike', 'category_name',
            $this->category_name,
        ]);

        return $dataProvider;
    }
}