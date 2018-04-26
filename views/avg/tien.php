<?php
/**
 * Created by PhpStorm.
 * User: sba010
 * Date: 4/18/2018
 * Time: 11:21 AM
 */

use kartik\date\DatePicker;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Báo cáo tiền nhập xuất');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'avg'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


$js = <<<JS



JS;

$this->registerJs($js, $this::POS_END);

?>

<div class="wrap">
    <div class="container">
        <div class="avg-form">



            <form action="/index.php" method="get">
                <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>"/>
                <input type="hidden" name="r" value="avg/tien">

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group field-avg-productname">
                            <?php
                            echo '<label class="control-label">Chọn khoảng thời gian</label>';

                            echo DatePicker::widget([
                                'name' => 'from_date',
                                'value' => $yearmondayfrom,
                                'type' => DatePicker::TYPE_RANGE,
                                'name2' => 'to_date',
                                'value2' => $yearmondayto,
                                'pluginOptions' => [
                                    'autoclose'=>true,
                                    'format' => 'yyyy-mm-dd'
                                ]
                            ]);
                            ?>


                            <div class="help-block"></div>
                        </div>
                    </div>
                    <div class="col-sm-6">

                    </div>
                </div>


                <input class="btn btn-success" type="submit">
                <br><br>

            </form>
        </div>


        <div class="product-index">
           	Tên sản phẩm	Tổng số tiền xuất	Tổng số tiền lời
            <?php
            if(isset($dataProvider))
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [

                    [
                        'label' => 'ID Sản Phẩm',
                        'value' => 'productid',
                    ],
                    [
                        'label' => 'Tên sản phẩm',
                        'value' => 'productname',
                    ],
                    [
                        'label' => 'Tổng số tiền xuất',
                        'value' => function ($arrData, $key, $index, $widget) {
                                return number_format(  $arrData['price_xuat']);
                        }
                    ],
                    [
                        'label' => 'Tổng số tiền xuất',
                        'value' => function ($arrData, $key, $index, $widget) {
                            return number_format(  $arrData['price_nhap']);
                        }
                    ],
                    [
                        'label' => 'Tổng số tiền lời',
                        'value' => function ($arrData, $key, $index, $widget) {
                            return number_format(  $arrData['price_loi']);
                        }
                    ],
                ],
            ]);
            ?>


            <div id="w0" class="grid-view hide-resize" data-krajee-grid="kvGridInit_0517ffd5">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                           Xuất nhập tiền
                        </h3>
                        <div class="clearfix"></div>
                    </div>
                    <div id="w0-container" class="table-responsive kv-grid-container">
                        <table class="kv-grid-table table table-striped kv-table-wrap ">
                            <thead>
                            <tr>
                                <th data-col-seq="0">ID Sản Phẩm</th>
                                <th data-col-seq="1">Tên sản phẩm</th>
                                <th data-col-seq="2">Tổng số tiền nhập</th>

                                <th data-col-seq="3">Tổng số tiền xuất </th>
                                <th data-col-seq="4">Tổng số tiền lời</th>
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
                                        data-col-seq="2"><?php echo($myitem['price_xuat']); ?>
                                    </td>
                                    <td style="text-align: left" data-col-seq="3">

                                        <?php echo($myitem['price_nhap']); ?>
                                    </td>
                                    <td style="text-align: left" data-col-seq="4">

                                        <?php echo($myitem['price_loi']); ?>
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


