<?php

use yii\helpers\Html;
use yii\web\JqueryAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Collection */
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/common.js',['depends' => [JqueryAsset::className()]]);
$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Collection'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="collection-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
<?php
function thuhoachi($flg_thuc){
    if($flg_thuc ==1){
        return "Thu";
    }else
    if($flg_thuc ==0){
        return "Chi";
    }
    return "";
}
?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'account.name',
            'time',
            'customer.name',       // description attribute formatted as HTML
            [                                                  // the owner name of the model
                'label' => 'Thu hoặc chi',
                'value' =>thuhoachi( $model->flg_thuchi),
                'contentOptions' => ['class' => 'bg-red'],     // HTML attributes to customize value tag
                'captionOptions' => ['tooltip' => 'Tooltip'],  // HTML attributes to customize label tag
            ],
            [                                                  // the owner name of the model
                'label' => 'Tiền',
                'value' =>number_format( $model->money),
            ],

            [
                'label' => 'Hình',
                'value'=>$model->image1,
                'format' => ['image',[]],
            ],
            'note',
        ],
    ]) ?>

</div>
