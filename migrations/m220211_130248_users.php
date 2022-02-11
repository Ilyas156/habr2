<?php

use yii\db\Migration;

/**
 * Class m220211_130248_users
 */
class m220211_130248_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('users', [
            'user_id' => $this->primaryKey(),
            'username' => $this->string(64)->unique()->notNull(),
            'email' => $this->string(255)->unique()->notNull(),
            'password' => $this->string(150)->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('users');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220211_130248_users cannot be reverted.\n";

        return false;
    }
    */
}
