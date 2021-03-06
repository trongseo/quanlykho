<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\web\JqueryAsset;
use yii\web\View;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use wbraganca\dynamicform\DynamicFormWidget;
use app\models\Product;
use app\models\Customer;

/* @var $this yii\web\View */
/* @var $model app\models\Delivery */
/* @var $form yii\widgets\ActiveForm */

$js = <<<JS
function updateMoney(){
    var money = new Number(0);
    $(".detail-total").each(function(){
      var removeCommsas =   $(this).html().replace(/,/g, "");
    var detail = new Number(removeCommsas);
    money += detail;
    });
    $("#delivery-money").val(money.toFixed(0));
    formatNumberAll();
}

var soluongtons;
$(document).ready(function(){
    $.post("index.php?r=avg/soluongtons",function (data) {
        soluongtons = JSON.parse(data);
    });
});
function getSoluongton(productid,objSelect) {
    var toReturn;
   
    for(var i = 0;i<soluongtons.length;i++){
        var v = soluongtons[i];
         if(v.productid == productid){
          
          var vitri =  $(objSelect).attr('id').split('-')[1];
          $(objSelect).parent().parent().parent().parent().find('.0soluongton').html("Tồn:<b>" +v.quantity_ton +"</b>");
         // $('.'+vitri+'soluongton').html( "Tồn:<b>" +v.quantity_ton +"</b>");
            return  v.quantity_ton;
        }
    }
     // $('.'+vitri+'soluongton').html( "");
      $(objSelect).parent().parent().parent().parent().find('.0soluongton').html("");
    // $.each(soluongtons, function(i,v){
    //     if(v.productid == productid){
    //         return  v.quantity_ton;
    //     }
    // });
    return 0;
}

var prices;
$(document).ready(function(){
    $.post("index.php?r=product/prices",function (data) {
        prices = JSON.parse(data);
    });
});

function getPrice(id) {
    var toReturn=0;
    $.each(prices, function(i,v){
          
        if(v.id == id){
             toReturn = v.price;
            // if(v.unit == "B") {
            //     toReturn = v.price;
            // } else {
            //     toReturn = (v.price * v.specification).toFixed(2);
            // }
            // return false;
        }
    });
    return toReturn;
}

$("body").on("keyup", ".detail-price", function() {
    
    debugger;
    var count_item =$(this).parent().parent().prev().prev().children().find(".detail-count") ;    //$(this).parent().parent().prev().children().children(".detail-count");
    var total_item = $(this).parent().parent().next().children("em");
    total_item.html(($(this).val() * count_item.val()).toFixed(0));
    
     var money  = addCommas($(this).val());
    $(this).parent().parent().find('.help-block').html(money);

    updateMoney();
});

$("body").on("change",".detail-product-id", function handleProduct(){
    var count_item = $(this).parent().parent().next().children().children(".detail-count");
    var price_item = count_item.parent().parent().next().children().children(".detail-price");
    var total_item = price_item.parent().parent().next().children("em");
    count = count_item.val()
    console.log("count:"+count);
    var product_id = $(this).val();
  
    if(product_id !== ""){
        var soluongton =  getSoluongton(product_id,this);
        console.log('soluongton:'+soluongton);
        price = getPrice(product_id);
        price_item.val(price);
        
          $(this).parent().parent().parent().parent().find('.detail-price').val(price);
        if(count !="") {
            console.log("total:"+ price*count);
             total_item.html((price * count).toFixed(0));
        }
    }else{
        price_item.val("0.00");
        total_item.html("0.00");
    }
    updateMoney();
});

$("body").on("change",".detail-count",function() {
    var product_item = $(this).parent().parent().prev().children().children(".detail-product-id");
    var price_item = $(this).parent().parent().next().children().children(".detail-price");
    var total_item = $(this).parent().parent().next().next().children("em");
    count = $(this).val();
    var product_id = product_item.val();
    if(!isNaN(count) && product_id != ""){
        price = price_item.val();
        total_item.html(addCommas((price * count).toFixed(0)));
        updateMoney();
    }
});

$("body").on("change", ".detail-price", function() {
    var count_item = $(this).parent().parent().prev().children().children(".detail-count");
    var total_item = $(this).parent().parent().next().children("em");
    total_item.html(($(this).val() * count_item.val()).toFixed(0));
    updateMoney();
});

 
JS;

$this->registerJs($js, $this::POS_END);
$this->registerJsFile(Yii::$app->request->baseUrl . '/js/common.js?d=8'.rand(), ['depends' => [JqueryAsset::className()]]);
$this->registerJsFile(Yii::$app->request->baseUrl . '/js/dynamicform.js', ['depends' => [\yii\web\JqueryAsset::className()], 'position' => View::POS_END]); ?>


<div class="delivery-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
    <div class="row">
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="form-group field-delivery-time">
                <label class="control-label" for="delivery-time"><?= Yii::t('app', 'Time') ?> </label>
                <?= DatePicker::widget([
                    'id' => 'delivery-time',
                    'name' => 'Delivery[time]',
                    'value' => $model->time ? $model->time : date('Y-m-d', strtotime('today')),
                    'options' => ['placeholder' => Yii::t('app', 'Select Time')],
                    'pluginOptions' => [
                        'format' => 'yyyy-m-dd',
                        'todayHighLight' => true,
                    ]
                ]); ?>
            </div>
            <?= $form->field($model, 'username')->hiddenInput(['value'=>  Yii::$app->user->username])->label(false); ?>
            <div class="col-sm-6">

                <?= $form->field($model, 'note')->textInput([
                    'type' => "string",
                ]) ?>
            </div>

            <div class="col-sm-6">
                <?php
                echo $form->field($model, 'customer_id')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(Customer::findAllforUser(), 'id', 'name'),
                    'language' => 'vn',
                    'options' => ['placeholder' => 'Tìm chọn khách hàng.'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
                ?>
            </div>

            <?= $form->field($model, 'money')->textInput(['readonly'=>'readonly','class'=>'number_format form-control'])->label("Tổng tiền:") ?>

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
                                    <div class="col-sm-12"><span class="<?=$i ?>soluongton">  </span> </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">

                                        <?php
                                        echo $form->field($modelDetail, "[{$i}]product_id")->widget(Select2::classname(), [
                                            'data' => ArrayHelper::map(Product::findAllforUser(), 'id', 'name'),
                                            'language' => 'vn',
                                            'options' => ['class'=>'detail-product-id','vitri'=>$i,'placeholder' => 'Chọn sản phẩm'],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                        ]);

                                        ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <?= $form->field($modelDetail, "[{$i}]count")->textInput([
                                            'maxlength' => true,
                                            'class' => 'form-control detail-count',
                                        ]) ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <?= $form->field($modelDetail, "[{$i}]price")->textInput([
                                            'maxlength' => true,
                                            'class' => 'number_format form-control detail-price',
                                        ]) ?>

                                    </div>

                                    <div class="col-sm-6">
                                        <label class="control-label"><?= Yii::t('app', 'Total') . ' : ' ?></label>
                                        <div class="clearfix"></div>
                                        <em class="pull-right detail-total">
                                            <?php
                                            if ($modelDetail->price) {
                                                echo number_format($modelDetail->price * $modelDetail->count, 0, '.', '');
                                            } else {
                                                echo '0';
                                            }
                                            ?>
                                        </em>
                                    </div>
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
