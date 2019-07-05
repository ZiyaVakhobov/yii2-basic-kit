<?php

use app\models\Role;
use app\models\User;
use lo\widgets\modal\ModalAjax;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <p>
        <?php
        echo ModalAjax::widget([
            'id' => 'createUser',
            'header' => 'Create User',
            'toggleButton' => [
                'label' => 'Create User',
                'class' => 'btn btn-success'
            ],
            'clientOptions' => [
                'backdrop' => 'static',
                'keyboard' => FALSE
            ],
            'url' => Url::to(['create']), // Ajax view with form to load
            'ajaxSubmit' => true, // Submit the contained form as ajax, true by default
            'size' => ModalAjax::SIZE_LARGE,
            'options' => [
                'class' => 'header-primary',
                'tabindex' => false,
                'backdrop' => 'static',
            ],
            'autoClose' => true,
            'pjaxContainer' => '#grid-company-pjax',

        ]);
        ?>
    </p>


    <?php
    echo \kartik\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'username',
            'created_at',
            [
                'class' => \yii\grid\DataColumn::class,
                'format' => 'raw',
                'header' => 'Role',
                'value' => function(User $user) {
                    $tr = '';
                    foreach ($user->userRoles as $item)
                    {
                        $tr .="<tr><td>{$item->role->name}</td></tr>";
                    }
                    return Html::tag('table',$tr,[
                        'class' => 'table table-responsive table-stripped'
                    ]);
                }
            ],
            [
                'class' => \yii\grid\DataColumn::class,
                'format' => 'raw',
                'header' => 'Permissions',
                'value' => function(User $user) {
                    $tr = '';
                    foreach ($user->authRelations as $item)
                    {
                        $tr .="<tr><td>{$item->authItem->name}</td></tr>";
                    }
                    return Html::tag('table',$tr,[
                        'class' => 'table table-responsive table-stripped'
                    ]);
                }
            ],
            'last_login',
            ['class' => 'yii\grid\ActionColumn'],
        ],
        'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false

        'toolbar' => [
            [
                'content' => ''
            ],
            '{export}',
            '{toggleData}'
        ],
        'pjax' => true,
        'bordered' => true,
        'striped' => false,
        'condensed' => false,
        'responsive' => true,
        'hover' => true,
        'floatHeader' => true,
        'showPageSummary' => true,
        'panel' => [
            'type' => \kartik\grid\GridView::TYPE_PRIMARY
        ],
    ]);
    ?>


</div>
