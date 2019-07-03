<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%auth_relation}}`.
 */
class m190703_132443_create_auth_relation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%auth_relation}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'auth_item_id' => $this->integer()
        ]);

        $this->addForeignKey(
            'fk_auth_relation_user_id',
            '{{%auth_relation}}',
            'user_id',
            '{{%user}}',
            'id',
            'cascade'
        );


        $this->addForeignKey(
            'fk_auth_relation_auth_item_id',
            '{{%auth_relation}}',
            'auth_item_id',
            '{{%auth_item}}',
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
            'fk_auth_relation_user_id',
            '{{%auth_relation}}'
        );
        $this->dropForeignKey(
            'fk_auth_relation_auth_item_id',
            '{{%auth_relation}}'
        );
        $this->dropTable('{{%auth_relation}}');
    }
}
