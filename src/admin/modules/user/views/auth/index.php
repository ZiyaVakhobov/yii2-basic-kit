<?php

/* @var $this \yii\web\View */

use kartik\grid\GridView;
use lo\widgets\modal\ModalAjax;
use yii\bootstrap\Html;
use yii\helpers\Url;

/* @var $dataProvider \yii\data\ActiveDataProvider */

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'username',
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