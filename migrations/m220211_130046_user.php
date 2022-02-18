<?php

use yii\db\Migration;

/**
 * Class m220211_130046_user
 */
class m220211_130046_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user', [
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
        $this->dropTable('user');

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
