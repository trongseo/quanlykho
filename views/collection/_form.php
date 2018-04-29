<?php

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
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/common.js?ver=3',['depends' => [JqueryAsset::className()]]);
?>

<div class="collection-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'account_id')->dropDownList(
        ArrayHelper::map(Account::find()->all(), 'id', 'name'),
        [
            'prompt' => Yii::t('app','Select Account'),
        ]
    ) ?>

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


    <?= $form->field($model, 'customer_id')->dropDownList(
        ArrayHelper::map(Customer::findAllforUser(), 'id', 'name'),
        [
            'prompt' => Yii::t('app','Select Customer'),
        ]
    ) ?>
    <?= $form->field($model, 'note')->textarea(['maxlength' => true])->label('Ghi chú') ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>

</script>