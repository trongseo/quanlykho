<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
    <h1>Import Data</h1>
    <a target="_blank" href="/uploads/importdata.xlsx"> tải mẫu </a>
<?php echo $err; ?>
<?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]);?>

<?= $form->field($model, 'excelFile')->fileInput() ?>
<?= Html::submitButton('Import',['class'=>'btn btn-primary']);?>

<?php ActiveForm::end();?>