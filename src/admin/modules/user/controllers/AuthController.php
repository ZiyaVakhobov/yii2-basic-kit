<?php

namespace app\src\admin\modules\user\controllers;


use app\models\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class AuthController extends Controller
{
    public function actionIndex()
    {
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
}