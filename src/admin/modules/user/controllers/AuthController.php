<?php

namespace app\src\admin\modules\user\controllers;


use app\models\Role;
use app\models\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class AuthController extends Controller
{
    public function actionIndex(): string
    {
        \Yii::$app->auth->can('canAccessAdmin');
        $dataProvider = new ActiveDataProvider([
            'query' => User::find()
                ->joinWith([
                    'userRoles'
                ])
        ]);
        return $this->render('index',[
            'dataProvider' => $dataProvider
        ]);
    }
    public function actionRoles(): string
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Role::find()
                ->joinWith([
                    'userRoles'
                ])
        ]);
        return $this->render('roles',[
            'dataProvider' => $dataProvider
        ]);
    }
}