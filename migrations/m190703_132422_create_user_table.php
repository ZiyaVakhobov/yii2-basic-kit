<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m190703_132422_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(32),
            'password' => $this->string(72),
            'authKey' => $this->string(72),
            'token' => $this->string(72),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
            'last_login' => $this->dateTime(),
            'status' => $this->smallInteger(2)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
