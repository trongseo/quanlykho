<?php

use app\models\Unit;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\JqueryAsset;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */

$js = <<<JS
$("body").on("keyup",".product-price1",function() {
    var count_item =$(this).parent().parent().prev().prev().children().find(".product-price1") ; 
    var total_item = $(this).parent().parent().next().children("em");
    total_item.html(($(this).val() * count_item.val()).toFixed(0));
    
     var money  = addCommas($(this).val());
    $(this).parent().find('.help-block').html(money);

    updateMoney();
});
JS;
$this->registerJs($js, $this::POS_END);
$this->registerJsFile(Yii::$app->request->baseUrl . '/js/common.js', ['depends' => [JqueryAsset::className()]]);
$this->registerJsFile(Yii::$app->request->baseUrl . '/js/dynamicform.js', ['depends' => [\yii\web\JqueryAsset::className()], 'position' => View::POS_END]);
?>


<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div style="display: none">
        <?= $form->field($model, 'unit')->dropDownList(['P' => Yii::t('app', 'Piece'), 'B' => Yii::t('app', 'Box'),], ['prompt' => Yii::t('app', 'Select Unit')]) ?>
    </div>

    <?php
    echo $form->field($model, 'unit_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\app\models\UnitPro::find()->all(), 'id', 'unit_name'),
        'language' => 'vn',
        'options' => ['placeholder' => 'Tìm chọn '],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);

    ?>

    <?= $form->field($model, 'username')->hiddenInput(['value' => Yii::$app->user->username])->label(false); ?>
    <input type="hidden" id="product-specification" value="0" class="form-control" name="Product[specification]"
           aria-required="true" aria-invalid="true">


    <?= $form->field($model, 'price')->textInput(['type' => 'number', 'class' => 'product-price1 form-control']) ?>

    <input type="hidden" id="product-cost" class="form-control" name="Product[cost]" value="0">

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
