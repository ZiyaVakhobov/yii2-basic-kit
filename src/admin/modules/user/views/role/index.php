<?php

use app\models\Role;
use lo\widgets\modal\ModalAjax;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Roles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">
            <?php
            echo ModalAjax::widget([
                'id' => 'createRole',
                'header' => 'Create Role',
                'toggleButton' => [
                    'label' => 'Create Role',
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
            <div class="clearfix">
                <br/>
            </div>
        </div>
        <div class="col-md-12">

            <?php
            echo \kartik\grid\GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    'id',
                    'name',
                    'description',
                    [
                        'class' => \yii\grid\DataColumn::class,
                        'format' => 'raw',
                        'value' => function(Role $role) {
                            $tr = '';
                            foreach ($role->roleItems as $item)
                            {
                                $tr .="<tr><td>{$item->authItem->name}</td></tr>";
                            }
                            return Html::tag('table',$tr,[
                                'class' => 'table table-responsive table-stripped'
                            ]);
                        }
                    ],
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
                    'type' => GridView::TYPE_PRIMARY
                ],
            ]);
            ?>
        </div>
    </div>
</div>
