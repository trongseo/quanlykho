<?php
/**
 * Created by PhpStorm.
 * User: sba010
 * Date: 4/9/2018
 * Time: 12:56 PM
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use wbraganca\dynamicform\DynamicFormWidget;
use app\models\Product;

/* @var $this yii\web\View */
/* @var $model app\models\bill */
/* @var $form yii\widgets\ActiveForm */


?>

<div class="bill-form">

    <div class="stockin-create">

        <h1>Nhập Phiếu


        <form >
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
            <select>
                <option value="1">cái</option>
                <option value="2">thùng</option>
                <option value="3">kg</option>
                <option value="4">tá</option>
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

    </div>

    </div>
