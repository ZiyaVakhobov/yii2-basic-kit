<?php

namespace app\src\admin;

/**
 * admin module definition class
 */
class Admin extends \yii\base\Module
{

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        $this->modules = [
            'user' => [
                'class' => 'app\src\admin\modules\user\User',
            ],
        ];
    }
}
