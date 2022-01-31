<?php

namespace app\models\article;

use yii\db\ActiveRecord;
use Yii;

class Category extends ActiveRecord
{

    public static function tableName()
    {
        return 'categories';
    }

    public function rules()
    {
        return [
            [['category_name'], 'required'],
        ];
    }

}