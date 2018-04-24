<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CollectionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Collections');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Collections'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="collection-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'bordered' => false,
        'tableOptions' => [
            'style'=>'text-align:center',
        ],
        'toolbar' => [
            ['content' => Html::a(Yii::t('app', 'Create Collection'),
                ['create'],
                ['class' => 'btn btn-success'])
            ],
        ],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Yii::t('app', 'Collection'),
        ],
        'columns' => [
            [
                'class' => 'kartik\grid\SerialColumn',
                'width' => '5%'
            ],

            [
                'attribute' => 'time',
                'format' => ['date','php:Y-m-d'],
                'filterType' => GridView::FILTER_DATE_RANGE,
                'filterWidgetOptions' => [
                    'presetDropdown' => true,
//                    'hideInput' => true,
                    'pluginOptions' => [
                        'locale' => [
                            'separator' => ' to ',
                            'format' => 'YYYY-MM-DD',
                        ],
                    ],
                ],
            ],
            [
                'attribute' => 'customer_id',
                'value' => 'customer.name',
            ],
//            [
//                'attribute' => 'account_id',
//                'value' => 'account.name',
//                'pageSummary' => Yii::t('app', 'Total'),
//            ],
//            [
////                'class' => 'kartik\grid\EditableColumn',
//                'attribute' => 'money',
//                'format' => ['decimal',0],
//                'pageSummary' => true,
//            ],
            [
                'attribute' => 'money',
                'format' => ['decimal',0],
                'value' => function ($model, $key, $index, $widget) {
                    if( $model->flg_thuchi==0){
                        return "-".$model->money;
                    }else{
                        return "".$model->money;
                    }

                },
                'pageSummary' => true,
            ],
            [
//                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'note',

            ],
            [
//                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'id',

            ],
            ['class' => 'kartik\grid\ActionColumn',
                'updateOptions' => ['hidden'=> true],
                'deleteOptions' => ['hidden' => true],
            ],
        ],
        'showPageSummary' => true,
    ]); ?>

</div>
