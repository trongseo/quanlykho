<?php

use app\models\Unit;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div style="display: none">
    <?= $form->field($model, 'unit')->dropDownList([ 'P' => Yii::t('app', 'Piece'), 'B' => Yii::t('app', 'Box'), ], ['prompt' => Yii::t('app', 'Select Unit')]) ?>
    </div>
    <?= $form->field($model, 'unit_id')->dropDownList(
        ArrayHelper::map(Unit::find()->all(), 'id', 'unit_name'),
        [
            'prompt' => Yii::t('app','Select'),
        ]
    ) ?>
    <input type="hidden" id="product-specification"   value="0" class="form-control" name="Product[specification]" aria-required="true" aria-invalid="true">
    <input type="hidden" id="product-price" class="form-control" name="Product[price]"  value="0">



    <input type="hidden" id="product-cost" class="form-control" name="Product[cost]" value="0" >
<!--    --><?php // $form->field($model, 'cost')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
