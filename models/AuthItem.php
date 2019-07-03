<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "auth_item".
 *
 * @property int $id
 * @property string $key
 * @property string $name
 * @property string $description
 *
 * @property AuthRelation[] $authRelations
 * @property RoleItem[] $roleItems
 */
class AuthItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'auth_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['key'], 'required'],
            [['key', 'name'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 400],
            [['key'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'key' => 'Key',
            'name' => 'Name',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthRelations()
    {
        return $this->hasMany(AuthRelation::className(), ['auth_item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoleItems()
    {
        return $this->hasMany(RoleItem::className(), ['auth_item_id' => 'id']);
    }
}
