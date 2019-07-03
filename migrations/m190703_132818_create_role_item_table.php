<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%role_item}}`.
 */
class m190703_132818_create_role_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%role_item}}', [
            'id' => $this->primaryKey(),
            'role_id' => $this->integer(),
            'auth_item_id' => $this->integer()
        ]);

        $this->addForeignKey(
            'fk_role_item_role_id',
            '{{%role_item}}',
            'role_id',
            '{{%role}}',
            'id',
            'cascade'
        );
        $this->addForeignKey(
            'fk_role_item_auth_item_id',
            '{{%role_item}}',
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
            'fk_role_item_role_id',
            '{{%role_item}}'
        );
        $this->dropForeignKey(
            'fk_role_item_auth_item_id',
            '{{%role_item}}'
        );
        $this->dropTable('{{%role_item}}');
    }
}
