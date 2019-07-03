<?php

namespace app\src\admin;

use yii\helpers\Url;

/**
 * admin module definition class
 */
class Admin extends \yii\base\Module
{

    public $controllerNamespace = 'app\src\admin\controllers';
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        \Yii::$app->homeUrl = Url::to('/admin');
        $this->modules = [
            'user' => [
                'class' => 'app\src\admin\modules\user\User',
            ],
        ];
    }
}
