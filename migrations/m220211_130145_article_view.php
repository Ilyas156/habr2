<?php

use yii\db\Migration;

/**
 * Class m220211_130145_article_view
 */
class m220211_130145_article_view extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('article_view', [
            'id' => $this->primaryKey(),
            'article_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'UNIQUE (article_id, user_id)'
        ]);
        $this->createIndex('FK_view_article_id', 'article_view', 'article_id');
        $this->addForeignKey(
            'FK_view_article_id',  'article_view', 'article_id', 
            'article', 'article_id', 'CASCADE', 'CASCADE'
        );

        $this->createIndex('FK_view_user_id', 'article_view', 'user_id');
        $this->addForeignKey(
            'FK_view_user_id',  'article_view', 'user_id', 
            'user', 'user_id', 'CASCADE', 'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('article_view');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220211_130145_article_views cannot be reverted.\n";

        return false;
    }
    */
}
