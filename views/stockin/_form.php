<?php

use yii\helpers\Html;
use yii\web\JqueryAsset;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use wbraganca\dynamicform\DynamicFormWidget;
use app\models\Product;

/* @var $this yii\web\View */
/* @var $model app\models\Stockin */
/* @var $form yii\widgets\ActiveForm */

$js = <<<JS
function updateMoney(){
    var money = new Number(0);
  //  debugger;
    $(".detail-total").each(function(){
    var detail = new Number($(this).html());
    money += detail;
    });
    $("#stockin-money").val(money.toFixed(0));
}

var prices;
$(document).ready(function(){
    $.post("index.php?r=product/prices",function (data) {
        prices = JSON.parse(data);
    });
    updateMoney();
});

function getPrice(id) {
    var toReturn;
    $.each(prices, function(i,v){
        if(v.id == id){
            if(v.unit == "B") {
                toReturn = v.price;
            } else {
                toReturn = (v.price * v.specification).toFixed(0);
            }
            return false;
        }
    });
    return toReturn;
}

$("body").on("change",".detail-product-id", function handleProduct(){
    var count_item = $(this).parent().parent().next().children().children(".detail-count");
    var price_item = count_item.parent().parent().next().next().children("em");
    var total_item = price_item.parent().next().children("em");
    count = count_item.val()
    var product_id = $(this).val();
    if(product_id !== ""){
        price = getPrice(product_id);
        price_item.html(price);
        if(count !="") {
             total_item.html((price * count).toFixed(0));
        }
    }else{
        price_item.html("0");
        total_item.html("0");
    }
    updateMoney();
});

$("body").on("change",".detail-count",function() {
    var product_item = $(this).parent().parent().prev().children().children(".detail-product-id");
    var total_item = $(this).parent().parent().next().next().next().children("em");
    count = $(this).val();
    var product_id = product_item.val();
    console.log(product_id);
    if(!isNaN(count) && product_id != ""){
       //  var price_item= $(this).parent().parent().next().next().children().children(".detail-price");
         price= $(this).parent().parent().next().next().children().find('.number_format').val();
       // var price = getPrice(product_id);
      // debugger;
       //  var price = price_item.val();
        total_item.html((price * count).toFixed(0));
        updateMoney();
    }
});

$("body").on("change", ".detail-price", function() {
    
    var count_item =$(this).parent().parent().prev().prev().children().find(".detail-count") ;    //$(this).parent().parent().prev().children().children(".detail-count");
    var total_item = $(this).parent().parent().next().children("em");
    total_item.html(($(this).val() * count_item.val()).toFixed(0));
    updateMoney();
});

JS;

$this->registerJs($js, $this::POS_END);
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/common.js',['depends' => [JqueryAsset::className()]]);
?>

<div class="stockin-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
    <div class="row">
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-sm-6">
                <div class="form-group field-stockin-time">
                    <label class="control-label" for="stockin-time"><?= Yii::t('app', 'Time') ?> </label>
                    <?= DatePicker::widget([
                        'id' => 'stockin-time',
                        'name' => 'Stockin[time]',
                        'value' => $model->time ? $model->time : date('Y-m-d', strtotime('today')),
                        'options' => ['placeholder' => Yii::t('app','Select Time')],
                        'pluginOptions' => [
                            'format' => 'yyyy-m-dd',
                            'todayHighLight' => true,
                        ]
                    ]);?>
                </div>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($model, 'money')->textInput(['type'=>'number','class'=>'number_format form-control']) ?>
                </div>
            </div>
            <div class="panel-body">
                <?php DynamicFormWidget::begin([
                    'widgetContainer' => 'dynamicform_wrapper',
                    'widgetBody' => '.container-items',
                    'widgetItem' => '.item',
                    'limit' => 10,
                    'min' => 1,
                    'insertButton' => '.add-item',
                    'deleteButton' => '.remove-item',
                    'model' => $modelDetails[0],
                    'formId' => 'dynamic-form',
                    'formFields' => [
                        'product_id',
                        'count',
                        'price'
                    ],
                ]); ?>
                <div class="container-items">
                    <?php foreach ($modelDetails as $i => $modelDetail): ?>
                        <div class="item panel panel-default"><!-- widgetBody -->
                            <div class="panel-heading">
                                <h3 class="panel-title pull-left"><?= Yii::t('app', 'Product') ?></h3>
                                <div class="pull-right">
                                    <button type="button" class="add-item btn btn-success btn-xs"><i
                                            class="glyphicon glyphicon-plus"></i></button>
                                    <button type="button" class="remove-item btn btn-danger btn-xs"><i
                                            class="glyphicon glyphicon-minus"></i></button>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <?php
                                // necessary for update action.
                                if (!$modelDetail->isNewRecord) {
                                    echo Html::activeHiddenInput($modelDetail, "[{$i}]id");
                                }
                                ?>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <?= $form->field($modelDetail, "[{$i}]product_id")->dropDownList(
                                            ArrayHelper::map(Product::find()->all(), 'id', 'name'),
                                            [
                                                'prompt' => Yii::t('app','Select Product'),
                                                'class' => 'form-control detail-product-id',
                                            ]
                                        ) ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <?= $form->field($modelDetail, "[{$i}]count")->textInput([
                                            'maxlength' => true,'myid'=>'đi', 'type' =>'number',
                                            'class' => 'form-control detail-count',
                                        ]) ?>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-sm-6">
                                        <?= $form->field($modelDetail, "[{$i}]price")->textInput([
                                            'maxlength' => true, 'type' =>'number',
                                            'class' => 'number_format  form-control detail-price',
                                        ]) ?>
                                        <strong><?= Yii::t('app', 'Price').' : ' ?></strong>
                                        <em class="pull-right" style="display: none">
                                        <?php
                                        if($modelDetail->product) {
                                            echo number_format(
                                                $modelDetail->product->unit =='B' ? $modelDetail->product->price:
                                                    $modelDetail->product->price * $modelDetail->product->specification,
                                                 0, '.', '');
                                        }else {
                                            echo '0';
                                        }
                                        ?>
                                        </em>
                                    </div>
                                    <div class="col-sm-6 pull-right">
                                        <strong><?= Yii::t("app", 'Total').' : ' ?></strong>
                                        <em class="pull-right detail-total"><?php
                                            if ($modelDetail->price){
                                                echo number_format($modelDetail->price * $modelDetail->count, 0, '.','');
                                            }else{
                                                echo '0';
                                            }
                                            ?>
                                        </em>
                                    </div>
                                    <div class="clearfix"></div>
                                </div><!-- .row -->
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php DynamicFormWidget::end(); ?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
