<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Bill */

//$this->title = Yii::t('app', 'Create Bill');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bill'), 'url' => ['create']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="wrap">
    <div class="container">
        <div class="bill-form">

            <form action="/index.php?r=bill%2Fcreate" method="post">
                <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>"/>
                <input type="text" hidden name="idwarehouse" value="">
                <div class="form-group field-bill-idchungtu required">
                    <label class="control-label">ID Chứng từ</label>
                    <input type="text" class="form-control" name="idchungtu">

                    <div class="help-block"></div>
                </div>

                <div class="form-group field-bill-idproduct required">
                    <label class="control-label" for="bill-idproduct">ID Sản phẩm</label>
                    <input type="text" id="bill-idproduct" class="form-control" name="idproduct" maxlength="128"
                           aria-required="true">

                    <div class="help-block"></div>
                </div>

                <div class="form-group field-bill-productname required">
                    <label class="control-label" for="bill-productname">Tên sản phẩm</label>
                    <input type="text" id="bill-productname" class="form-control" name="productname" maxlength="128"
                           aria-required="true">

                    <div class="help-block"></div>
                </div>

                <div class="form-group field-bill-unit">
                    <label class="control-label" for="bill-unit">Đơn vị</label>
                    <select id="bill-unit" class="form-control" name="unit">
                        <?php

                        foreach ($comboboxdata as $combobox) {
                            ?>
                            <option
                                value="<?php echo($combobox['id']); ?>"><?php echo($combobox['unit_name']); ?></option>
                            <?php
                        }
                        ?>
                    </select>

                    <div class="help-block"></div>
                </div>
                <div class="form-group field-bill-count required">
                    <label class="control-label" for="bill-count">Số lượng</label>
                    <input type="text" id="bill-count" class="form-control" name="count" maxlength="128"
                           aria-required="true">

                    <div class="help-block"></div>
                </div>

                <div class="form-group field-bill-price required">
                    <label class="control-label" for="bill-price">Giá bán</label>
                    <input type="text" id="bill-price" class="form-control" name="price" aria-required="true">

                    <div class="help-block"></div>
                </div>
                <div class="form-group field-bill-cost required">
                    <label class="control-label" for="bill-cost">Giá</label>
                    <input type="text" id="bill-cost" class="form-control" name="cost" aria-required="true">

                    <div class="help-block"></div>
                </div>

                <div class="form-group field-bill-date required">
                    <label class="control-label" for="bill-date">Ngày nhập phiếu</label>
                    <input type="date" id="bill-date" class="form-control" name="date" aria-required="true">

                    <div class="help-block"></div>
                </div>
                <div class="form-group field-bill-idnhacungcap required">
                    <label class="control-label" for="bill-idnhacungcap">ID Nhà Cung Cấp</label>
                    <input type="text" id="bill-idnhacungcap" class="form-control" name="idnhacungcap"
                           aria-required="true">
                    <div class="help-block"></div>
                </div>
                <div class="form-group field-bill-note required">
                    <label class="control-label" for="bill-note">Ghi chú</label>
                    <input type="text" id="bill-note" class="form-control" name="note" aria-required="true">

                    <div class="help-block"></div>
                </div>
                <input type="submit">
            </form>
        </div>

    </div>
</div>
</div>


<script src="/assets/d70fefba/jquery.js"></script>
<script src="/assets/41dee904/yii.js"></script>
<script src="/assets/41dee904/yii.validation.js"></script>
<script src="/assets/41dee904/yii.activeForm.js"></script>
<script src="/assets/bc28ee4d/js/bootstrap.js"></script>

