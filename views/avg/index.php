<?php
/**
 * Created by PhpStorm.
 * User: sba010
 * Date: 4/18/2018
 * Time: 11:21 AM
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Trung Bình Giá');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'avg'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="wrap">
    <div class="container">
        <div class="avg-form">

            <form action="/index.php?r=avg%2Findex" method="post">
                <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>"/>


                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group field-avg-productname">
                            <label class="control-label" for="avg-month">Chọn Tháng</label>
                            <select id="month_avg" name="month_avg" class="form-control">
                                <option value="01">Tháng 1</option>
                                <option value="02">Tháng 2</option>
                                <option value="03">Tháng 3</option>
                                <option value="04">Tháng 4</option>
                                <option value="05">Tháng 5</option>
                                <option value="06">Tháng 6</option>
                                <option value="07">Tháng 7</option>
                                <option value="08">Tháng 8</option>
                                <option value="09">Tháng 9</option>
                                <option value="10">Tháng 10</option>
                                <option value="11">Tháng 11</option>
                                <option value="12">Tháng 12</option>
                            </select>
                            <div class="help-block"></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group field-bill-date required">
                            <label class="control-label" for="year_avg">Chọn Năm</label>
                            <input type="number" class="form-control" id="year_avg" name="year_avg" min="1900"
                                   max="2099"
                                   step="1" value="2018"/>
                            <div class="help-block"></div>
                        </div>
                    </div>
                </div>


                <input class="btn btn-success" type="submit">
                <br><br>

            </form>
        </div>


        <div class="product-index">


            <div id="w0" class="grid-view hide-resize" data-krajee-grid="kvGridInit_0517ffd5">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Giá trung bình
                        </h3>
                        <div class="clearfix"></div>
                    </div>
                    <div id="w0-container" class="table-responsive kv-grid-container">
                        <table class="kv-grid-table table table-striped kv-table-wrap ">
                            <thead>
                            <tr>
                                <th data-col-seq="0">ID Sản Phẩm</th>
                                <th data-col-seq="1">Tên sản phẩm</th>
                                <th data-col-seq="2">Tổng số lượng</th>
                                <th data-col-seq="3">Giá trung bình</th>
                                <th data-col-seq="4">Thời gian</th>
                            </tr>

                            </thead>
                            <tbody>

                            <?php

                            foreach ($giatrungbinh as $myitem) {
                                ?>

                                <tr data-key="1">
                                    <td style="text-align: left"
                                        data-col-seq="0"><?php echo($myitem['productid']); ?></td>
                                    <td style="text-align: left"
                                        data-col-seq="1"><?php echo($myitem['productname']); ?></td>
                                    <td style="text-align: left"
                                        data-col-seq="2"><?php echo($myitem['quantity']); ?></td>
                                    <td style="text-align: left" data-col-seq="3"><?php echo($myitem['price']); ?></td>
                                    <td style="text-align: left" data-col-seq="4">


                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="kv-panel-after"></div>
                    <div class="panel-footer">
                        <div class="kv-panel-pager">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        <input type="button" value="Backup Month" class="btn btn-success" onClick="document.location.href='/index.php?r=avg%2Fmonthavg'" />

    </div>
</div>

</div>

<script src="/assets/d70fefba/jquery.js"></script>
<script src="/assets/41dee904/yii.js"></script>
<script src="/assets/41dee904/yii.validation.js"></script>
<script src="/assets/41dee904/yii.activeForm.js"></script>
<script src="/assets/bc28ee4d/js/bootstrap.js"></script>


