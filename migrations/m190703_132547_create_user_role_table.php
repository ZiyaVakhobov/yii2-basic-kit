<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_role}}`.
 */
class m190703_132547_create_user_role_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_role}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'role_id' => $this->integer(),
        ]);

        $this->addForeignKey(
            'fk_user_role_user_id',
            '{{%user_role}}',
            'user_id',
            '{{%user}}',
            'id',
            'cascade'
        );

        $this->addForeignKey(
            'fk_user_role_role_id',
            '{{%user_role}}',
            'role_id',
            '{{%role}}',
            'id',
            'cascade'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk_user_role_user_id',
            '{{%user_role}}'
        );
        $this->dropForeignKey(
            'fk_user_role_role_id',
            '{{%user_role}}'
        );
        $this->dropTable('{{%user_role}}');
    }
}
