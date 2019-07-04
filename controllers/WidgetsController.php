<?php


namespace app\controllers;


use yii\web\Controller;

class WidgetsController extends Controller
{
    public function actionKartikInputs()
    {
        return $this->render('kartik-inputs');
    }
}