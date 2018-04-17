<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Bill */

$this->title = Yii::t('app', 'Create Unit');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Unit'), 'url' => ['create']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="wrap">
    <div class="container">
            <div class="unit-form">

                <form action="/index.php?r=unit%2Fcreate" method="post">
                    <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                    <div class="form-group field-unit-unit_name required">
                        <label class="control-label">Unit Name</label>
                        <input type="text" class="form-control" name="unit_name" >
                        <div class="help-block"></div>
                    </div>
                        <input type="submit" >

                </form>
            </div>

        </div>
    </div>



<script src="/assets/d70fefba/jquery.js"></script>
<script src="/assets/41dee904/yii.js"></script>
<script src="/assets/41dee904/yii.validation.js"></script>
<script src="/assets/41dee904/yii.activeForm.js"></script>
<script src="/assets/bc28ee4d/js/bootstrap.js"></script>

