<?php

use yii\db\Migration;

/**
 * Class m220211_130134_article_like
 */
class m220211_130134_article_like extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('article_like', [
           'id' => $this->primaryKey(),
           'article_id' => $this->integer()->notNull(),
           'user_id' => $this->integer()->notNull(),
           'UNIQUE (article_id, user_id)'
        ]);
        
        $this->createIndex('FK_article_id', 'article_like', 'article_id');
        $this->addForeignKey(
            'FK_article_id',  'article_like', 'article_id', 
            'article', 'article_id', 'SET NULL', 'CASCADE'
        );

        $this->createIndex('FK_user_id', 'article_like', 'user_id');
        $this->addForeignKey(
            'FK_user_id',  'article_like', 'user_id', 
            'user', 'user_id', 'SET NULL', 'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('article_like');

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
