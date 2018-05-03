<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UnitproSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Unitpros');

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Unitpros'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="Unitpro-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => [
            'style'=>'text-align:left',
        ],
        'bordered' => false,
        'toolbar' => [
            [
                'content' => Html::a(Yii::t('app', 'Create Unitpro'),
                    ['create'],
                    ['class' => 'btn btn-success'])
            ],
        ],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Yii::t('app', 'Unitpro'),
        ],
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
           "id"
            ,
            [
                'attribute' => 'unit_name',
                'format' => 'raw',
                'width' => '20%',
                'value' => function ($model, $key, $index, $widget) {
                    return Html::a($model->unit_name,
                        'index.php?r=Unitpro%2Fview&id='.$model->id
                    );
                }
            ],




        ],
    ]); ?>
</div>
