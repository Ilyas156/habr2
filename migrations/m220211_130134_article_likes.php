<?php

use yii\db\Migration;

/**
 * Class m220211_130134_article_likes
 */
class m220211_130134_article_likes extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('article_likes', [
           'id' => $this->primaryKey(),
           'article_id' => $this->integer()->notNull(),
           'user_id' => $this->integer()->notNull(),
           'UNIQUE (article_id, user_id)'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('article_likes');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220211_130134_article_likes cannot be reverted.\n";

        return false;
    }
    */
}
