<?php

use yii\db\Migration;

/**
 * Class m220211_130047_category
 */
class m220211_130047_category extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('category', [
            'category_id' => $this->primaryKey(),
            'category_name' => $this->string(255)->notNull()->unique()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('category');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220211_130228_categories cannot be reverted.\n";

        return false;
    }
    */
}
