<?php

use yii\db\Migration;

/**
 * Class m220211_130048_articles
 */
class m220211_130048_articles extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('articles', [
            'article_id' => $this->primaryKey(),
            'title' => $this->string(50)->notNull(),
            'description' => $this->char(800)->notNull(),
            'content' => $this->text()->notNull(),
            'user_id' => $this->integer(),
            'image' => $this->char(100)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('articles');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220211_130048_articles cannot be reverted.\n";

        return false;
    }
    */
}
