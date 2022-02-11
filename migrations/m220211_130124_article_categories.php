<?php

use yii\db\Migration;

/**
 * Class m220211_130124_article_categories
 */
class m220211_130124_article_categories extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('article_categories', [
           'article_id' => $this->integer()->notNull(),
           'category_id' =>  $this->integer()->notNull(),
            'PRIMARY KEY (article_id, category_id)'
        ]);
        $this->createIndex('FK_article_categories_article_id', 'article_categories', 'article_id');
        $this->createIndex('FK_article_categories_category_id', 'article_categories', 'category_id');
        $this->addForeignKey('FK_article_categories_article_id', 'article_categories', 'article_id',
        'articles', 'article_id'
        );
        $this->addForeignKey('FK_article_categories_category_id', 'article_categories', 'category_id',
            'categories', 'category_id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('article_categories');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220211_130124_article_categories cannot be reverted.\n";

        return false;
    }
    */
}
