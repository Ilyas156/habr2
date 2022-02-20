<?php

use yii\db\Migration;

/**
 * Class m220211_130324_article_category
 */
class m220211_130324_article_category extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('article_category', [
           'article_id' => $this->integer()->notNull(),
           'category_id' =>  $this->integer()->notNull(),
            'PRIMARY KEY (article_id, category_id)'
        ]);

        $this->createIndex('FK_article_id', 'article_category', 'article_id');
        $this->addForeignKey(
            'FK_article_id',  'article_category', 'article_id', 
            'article', 'article_id', 'CASCADE', 'CASCADE'
        );

        $this->createIndex('FK_category_id', 'article_category', 'category_id');
        $this->addForeignKey(
            'FK_category_id',  'article_category', 'category_id', 
            'category', 'category_id', 'CASCADE', 'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('article_category');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220211_130324_article_categories cannot be reverted.\n";

        return false;
    }
    */
}
