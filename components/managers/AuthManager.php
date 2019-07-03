<?php


namespace app\components\managers;

use app\components\exceptions\HttpNotAllowedException;
use app\models\AuthItem;
use yii\base\Component;
use yii\db\Query;

class AuthManager extends Component
{

    public $cache = 'cache';

    /**
     * @var \yii\caching\Cache
     */
    public $cacheEngine;

    public function init()
    {
        parent::init();
        $this->cacheEngine = \Yii::$app->{$this->cache};
        $this->cacheEngine->defaultDuration = 180;
    }

    /**
     * @param string $permissionName
     * @param bool $allowCaching
     * @return bool|void
     * @throws HttpNotAllowedException
     */
    public function can($permissionName, $allowCaching = true)
    {
        $authItem = $this->getAuthItem($permissionName);
        if ($authItem) {
            $allowed = $this->isAllowed($authItem);
            if ($allowed) {
                return;
            }

        }
        throw new HttpNotAllowedException(\Yii::t('app','Action not allowed'));
    }

    /**
     * @param array $permissions
     * @return bool
     */
    public function checkAccess($permissions = []):bool
    {
        $isAllowed = false;
        foreach ($permissions as $permissionName) {
            $authItem = $this->getAuthItem($permissionName);
            if ($authItem) {
                $isAllowed = $this->isAllowed($authItem);
            }
        }
        return $isAllowed;
    }

    public function canAccess(string $permissionName): bool
    {
        return $this->isAllowed(
            $this->getAuthItem(
                $permissionName
            )
        );
    }

    private function getAuthItem(string $permissionName)
    {
        return $this->cacheEngine->getOrSet($permissionName.'_auth_item_'.\Yii::$app->user->id, static function()use ($permissionName){
            $item =  AuthItem::findOne(['key'=>$permissionName]);
            return $item->id??null;
        });

    }

    private function isAllowed($authItem)
    {
        return $this->cacheEngine->getOrSet($authItem.'_is_allowed_'.\Yii::$app->user->id, static function() use ($authItem){
            return (new Query())
                ->from('auth_relation')
                ->where(['auth_relation.user_id'=>\Yii::$app->user->id])
                ->andWhere(['auth_relation.auth_item_id'=>$authItem])
                ->exists();
        });
    }
}