<?php

use kartik\file\FileInput;
use kartik\select2\Select2;
use uranum\excel\ExcelExchanger;
use yii\helpers\Html;
use yii\web\JqueryAsset;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use app\models\Account;
use app\models\Customer;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Collection */
/* @var $form yii\widgets\ActiveForm */


$js = <<<JS
$( document ).ready(function() {

    $(".number_format").keyup(function(){

        formatNumber($(this));
    });

    formatNumberAll();

});
JS;

$this->registerJs($js, $this::POS_END);
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/common.js?ver=3'.rand(),['depends' => [JqueryAsset::className()]]);

?>

<div class="collection-form">

    <?php $form = ActiveForm::begin(); ?>


    <?php
    echo $form->field($model, 'account_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\app\models\Account::find()->all(), 'id', 'name'),
        'language' => 'vn',
        'options' => ['placeholder' => 'Tìm chọn '],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);

    ?>
    <div class="form-group field-collection-time">
        <label class="control-label" for="collection-time"><?= Yii::t('app', 'Time') ?> </label>
        <?= DatePicker::widget([
            'id' => 'collection-time',
            'name' => 'Collection[time]',
            'value' => $model->time ? $model->time : date('Y-m-d', strtotime('today')),
            'options' => ['placeholder' => Yii::t('app','Select Time')],
            'pluginOptions' => [
                'format' => 'yyyy-m-dd',
                'todayHighLight' => true,
            ]
        ]);?>
    </div>
    <?php
//    var_dump($model);exit();
    ?>


    <?= $form->field($model, 'flg_thuchi')->radioList([1 => 'Thu tiền', 0 => 'Chi tiền'])->label('Thu chi'); ?>


    <?= $form->field($model, 'username')->hiddenInput(['value'=>  Yii::$app->user->username])->label(false); ?>
    <?= $form->field($model, 'money')->textInput(['class'=>'number_format form-control','type'=>'number','maxlength' => true])->label('Số tiền') ?>
<?php
echo  $form->field($model, 'image1')->widget(FileInput::classname(), [
    'options' => ['accept' => 'image/*'],
    'pluginOptions'=>['allowedFileExtensions'=>['jpg','gif','png'],
        'showUpload' => false,
        'initialPreview'=> [
            '<img src="'.$model->image1.'" class="file-preview-image">',
        ],
    ],
])->label("Hình chứng từ");

?>


    <?php
    echo $form->field($model, 'customer_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\app\models\Customer::find()->all(), 'id', 'name'),
        'language' => 'vn',
        'options' => ['placeholder' => 'Tìm chọn '],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);

    ?>
    <?= $form->field($model, 'note')->textarea(['maxlength' => true])->label('Ghi chú') ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<style>
    .file-preview-image {
        max-width: 150px;
    }
</style>