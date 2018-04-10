<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Create Bill');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bill'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<form action="/index.php?r=bill%2Findex" method="post">
    First name:<br><input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
    <input type="text" name="productname" value="">
    <br>
    Last name:<br>
    <input type="text" name="lastname" value="Mouse">
    <br><br>
    <input type="submit" value="Submit">
</form>