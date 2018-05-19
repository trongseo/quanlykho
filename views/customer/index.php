<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Customers');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Customers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tạo khách hàng mới', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'tableOptions' => [
        'style'=>'text-align:center',
    ],
    'bordered' => false,

    'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => Yii::t('app', 'Customer'),
    ],
    'columns' => [
        [
            'class' => 'kartik\grid\SerialColumn',
            'width' => '5%'
        ],

        [
            'attribute' => 'name',
            'format' => 'raw',
            'width' => '10%',
            'value' => function ($model, $key, $index, $widget) {
                return Html::a($model->name,
                    'index.php?r=customer%2Fview&id='.$model->id
                );
            }
        ],
        [
            'width' => '40%',
            'attribute' => 'info',
        ],
//        [
//            'attribute' => 'time',
//            'format' => ['datetime','php:Y-m-d'],
//            'filterType' => GridView::FILTER_DATE_RANGE,
//            'filterWidgetOptions' => [
//                'presetDropdown' => true,
//                'pluginOptions' => [
//                    'locale' => [
//                        'separator' => ' to ',
//                        'format' => 'YYYY-MM-DD',
//                    ],
//                ],
//            ],
//        ],
//        [
//            'attribute' => 'sum',
//            'width' => '10%',
//            'format' => ['decimal', 2],
//        ],
//        [
//            'attribute' => 'payed',
//            'width' => '10%',
//            'format' => ['decimal', 2],
//        ],
//        [
//            'attribute' => 'unpay',
//            'width' => '10%',
//            'format' => ['decimal', 2],
//        ],
    ],
]); ?>

</div>
