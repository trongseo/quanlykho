<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'View All Bill');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bill'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">


    <div id="w0" class="grid-view hide-resize" data-krajee-grid="kvGridInit_0517ffd5">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="pull-right">
                    <div class="summary">Showing <b>1-12</b> of <b>12</b> items.</div>
                </div>
                <h3 class="panel-title">
                    Nhập phiếu
                </h3>
                <div class="clearfix"></div>
            </div>
            <div class="kv-panel-before">
                <div class="btn-toolbar kv-grid-toolbar toolbar-container pull-right">
                    <div style="margin-top: 5%" class="btn-group"><a class="btn btn-success" href="/index.php?r=bill%2Fcreate">Tạo phiếu
                            nhập</a>
                    </div>
                </div>

                <div class="clearfix"></div>
            </div>
            <div id="w0-container" class="table-responsive kv-grid-container">
                <table class="kv-grid-table table table-striped kv-table-wrap " >
                    <thead>
                    <tr>
                        <th data-col-seq="0"><a href="/index.php?r=bill%2Findex&amp;sort=idwarehouse"
                                                data-sort="idwarehouse">ID Phiếu</a></th>
                        <th data-col-seq="1"><a href="/index.php?r=bill%2Findex&amp;sort=idchungtu"
                                                data-sort="idchungtu">ID Chứng Từ</a></th>
                        <th data-col-seq="2"><a href="/index.php?r=bill%2Findex&amp;sort=productname"
                                                data-sort="productname">Tên Sản Phẩm</a></th>
                        <th data-col-seq="3"><a href="/index.php?r=bill%2Findex&amp;sort=unit" data-sort="unit">Đơn
                                vị</a></th>
                        <th data-col-seq="4"><a href="/index.php?r=bill%2Findex&amp;sort=price" data-sort="price">Giá
                                bán</a></th>
                        <th data-col-seq="5"><a href="/index.php?r=bill%2Findex&amp;sort=cost" data-sort="cost">Giá</a>
                        </th>
                        <th data-col-seq="6"><a href="/index.php?r=bill%2Findex&amp;sort=date" data-sort="date">Ngày
                                nhập</a></th>
                    </tr>

                                        <tr id="w0-filters" class="filters skip-export">
                                            <td><input type="text" class="form-control" name="searchidưarehouse"></td>
                                            <td><input type="text" class="form-control" name="searchidchungtu"></td>
                                            <td><input type="text" class="form-control" name="searchproductname"></td>
                                            <td><input type="text" class="form-control" name="searchunit_name"></td>
                                            <td><input type="text" class="form-control" name="searchprice"></td>
                                            <td><input type="text" class="form-control" name="searchcost"></td>
                                            <td><input type="date" class="form-control" name="searchdate"></td>
                                        </tr>

                    </thead>
                    <tbody>

                    <?php

                    foreach ($datas as $myitem) {
                        ?>

                        <tr data-key="1">
                            <td style="text-align: left" data-col-seq="0"><a
                                    href="index.php?r=bill/update&id=<?php echo($myitem['idwarehouse']); ?>"><?php echo($myitem['idwarehouse']); ?></a>
                            </td>
                            <td style="text-align: left" data-col-seq="1"><?php echo($myitem['idchungtu']); ?></td>
                            <td style="text-align: left" data-col-seq="2"><?php echo($myitem['productname']); ?></td>
                            <td style="text-align: left" data-col-seq="3"><?php echo($myitem['unit_name']); ?></td>
                            <td style="text-align: left" data-col-seq="4"><?php echo($myitem['price']); ?></td>
                            <td style="text-align: left" data-col-seq="5"><?php echo($myitem['cost']); ?></td>
                            <td style="text-align: left" data-col-seq="6">
                                <?php
                                $date = date_create($myitem['date']);
                                echo date_format($date, "m/d/Y") ?>
                            </td>
                            <td >
                                <a style="border:rgba(251, 56, 33, 0.96) solid;padding: 5%;background-color: red; color: white" href="/index.php?r=bill%2Fdelete&amp;id=<?php echo($myitem['idwarehouse']); ?>" data-confirm="Chắc chắn xóa phiếu này chứ ?" data-method="post">Xóa</a></td>
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
