<?php

use app\models\AuthItem;
use app\models\Role;
use unclead\multipleinput\MultipleInput;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \app\src\admin\modules\user\forms\UserForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?php
    echo $form->field($model, 'permissions')->widget(MultipleInput::className(), [
        'allowEmptyList'    => false,
        'enableGuessTitle'  => true,
        'addButtonPosition' => MultipleInput::POS_HEADER, // show add button in the header
        'columns' => [
            [
                'name'  => 'item',
                'type'  => \kartik\select2\Select2::class,
                'title' =>'',
                'options' => [
                    'options' => [
                        'placeholder'=>'...',
                    ],
                    'data' => ArrayHelper::map(AuthItem::find()->all(),'id','name'),
                ]
            ],
        ]
    ]);
    ?>
    <?php
    echo $form->field($model, 'roles')->widget(MultipleInput::className(), [
        'allowEmptyList'    => false,
        'enableGuessTitle'  => true,
        'addButtonPosition' => MultipleInput::POS_HEADER, // show add button in the header
        'columns' => [
            [
                'name'  => 'item',
                'type'  => \kartik\select2\Select2::class,
                'title' =>'',
                'options' => [
                    'options' => [
                        'placeholder'=>'...',
                    ],
                    'data' => ArrayHelper::map(Role::find()->all(),'id','name'),
                ]
            ],
        ]
    ]);
    ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
