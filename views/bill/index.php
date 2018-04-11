<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Create Bill');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bill'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<form action="/index.php?r=bill%2Findex" method="post">
    <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
    <input type="text" hidden name="idwarehouse" value="">
    date:
    <input type="time" name="date" value="">
    <br>
    id chứng từ:
    <input type="text" name="idchungtu" value="">
    <br><br>
    id products:
    <input type="text" name="idproduct" value="">
    <br><br>
    product name:
    <input type="text" name="productname" value="">
    <br><br>
    unit:
    <select name="unit">
        <option value="cái" >cái</option>
    </select>
    <br><br>
    count:
    <input type="text" name="count" value="">
    <br><br>
    price:
    <input type="text" name="price" value="">
    <br><br>
    cost:
    <input type="text" name="cost" value="">
    <br><br>
    id nhà cung cấp:
    <input type="text" name="idnhacungcap" value="">
    <br><br>
    note:
    <input type="text" name="note" value="">
    <br>

    <br>
    <input type="submit" value="Submit">
</form>