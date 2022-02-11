<?php

use yii\db\Migration;

/**
 * Class m220211_130228_categories
 */
class m220211_130228_categories extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('categories', [
            'category_id' => $this->primaryKey(),
            'category_name' => $this->string(255)->notNull()->unique()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('categories');

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
