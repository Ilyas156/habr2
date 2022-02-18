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
        $this->createTable('article', [
            'article_id' => $this->primaryKey(),
            'title' => $this->string(50)->notNull(),
            'description' => $this->string(800)->notNull(),
            'content' => $this->text()->notNull(),
            'user_id' => $this->integer(),
            'image' => $this->string(100)
        ]);
        $this->createIndex('FK_article_author', 'article', 'user_id');
        $this->addForeignKey(
            'FK_article_author', 'article', 'user_id', 'user', 'user_id', 'SET NULL', 'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('article');

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
