<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Create Bill');
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
                    <div class="btn-group"><a class="btn btn-success" href="/index.php?r=bill%2Fcreate">Tạo phiếu
                            nhập</a>
                    </div>
                </div>

                <div class="clearfix"></div>
            </div>
            <div id="w0-container" class="table-responsive kv-grid-container">
                <table class="kv-grid-table table table-striped kv-table-wrap" style="text-align:center">
                    <thead>
                    <tr>
                        <th data-col-seq="0"><a href="/index.php?r=bill%2Findex&amp;sort=idwarehouse" data-sort="idwarehouse">ID Phiếu</a></th>
                        <th data-col-seq="1"><a href="/index.php?r=bill%2Findex&amp;sort=idchungtu" data-sort="idchungtu">ID Chứng Từ</a></th>
                        <th data-col-seq="2"><a href="/index.php?r=bill%2Findex&amp;sort=productname" data-sort="productname">Tên Sản Phẩm</a></th>
                        <th data-col-seq="3"><a href="/index.php?r=bill%2Findex&amp;sort=unit" data-sort="unit">Đơn vị</a></th>
                        <th data-col-seq="4"><a href="/index.php?r=bill%2Findex&amp;sort=price" data-sort="price">Giá bán</a></th>
                        <th data-col-seq="5"><a href="/index.php?r=bill%2Findex&amp;sort=cost" data-sort="cost">Giá</a></th>
                        <th data-col-seq="6"><a href="/index.php?r=bill%2Findex&amp;sort=date" data-sort="date">Ngày nhập</a></th>
                    </tr>

<!--                    <tr id="w0-filters" class="filters skip-export">-->
<!--                        <td><input type="text" class="form-control" name="billSearch[name]"></td>-->
<!--                        <td><input type="text" class="form-control" name="billSearch[unit]"></td>-->
<!--                        <td><input type="text" class="form-control" name="billSearch[specification]"></td>-->
<!--                        <td><input type="text" class="form-control" name="billSearch[price]"></td>-->
<!--                        <td><input type="text" class="form-control" name="billSearch[cost]"></td>-->
<!--                    </tr>-->

                    </thead>
                    <tbody>

                    <?php

                    foreach ($datas as $myitem) {
                        ?>


                        <tr data-key="1">
                            <td class="kv-align-center kv-align-middle" style="width:50px;" data-col-seq="0"><a href="index.php?r=bill%2Fview&amp;id=<?php echo ($myitem['idwarehouse']); ?>"><?php echo ($myitem['idwarehouse']); ?></a></td>
                            <td class="kv-align-center kv-align-middle" data-col-seq="1"><?php echo ($myitem['idchungtu']); ?></td>
                            <td class="kv-align-center kv-align-middle" style="width:20%;" data-col-seq="2"><?php echo ($myitem['productname']); ?></td>
                            <td class="kv-align-center kv-align-middle" data-col-seq="3"><?php echo ($myitem['unit']); ?></td>
                            <td class="kv-align-center kv-align-middle" data-col-seq="4"><?php echo ($myitem['price']); ?></td>
                            <td class="kv-align-center kv-align-middle" data-col-seq="5"><?php echo ($myitem['cost']); ?></td>
                            <td class="kv-align-center kv-align-middle" data-col-seq="6"><?php echo ($myitem['date']); ?></td>
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

<!---->
<!--<form  action="/index.php?r=bill%2Findex" method="post">-->
    <input type="hidden" name="_csrf" value="<? //=Yii::$app->request->getCsrfToken()?>" />
<!--    <input type="text" hidden name="idwarehouse" value="">-->
<!--    date:-->
<!--    <input type="time" name="date" value="">-->
<!--    <br>-->
<!--    id chứng từ:-->
<!--    <input type="text" name="idchungtu" value="">-->
<!--    <br><br>-->
<!--    id products:-->
<!--    <input type="text" name="idproduct" value="">-->
<!--    <br><br>-->
<!--    product name:-->
<!--    <input type="text" name="productname" value="">-->
<!--    <br><br>-->
<!--    unit:-->
<!--    <select name="unit">-->
<!--        <option value="cái" >cái</option>-->
<!--    </select>-->
<!--    <br><br>-->
<!--    count:-->
<!--    <input type="text" name="count" value="">-->
<!--    <br><br>-->
<!--    price:-->
<!--    <input type="text" name="price" value="">-->
<!--    <br><br>-->
<!--    cost:-->
<!--    <input type="text" name="cost" value="">-->
<!--    <br><br>-->
<!--    id nhà cung cấp:-->
<!--    <input type="text" name="idnhacungcap" value="">-->
<!--    <br><br>-->
<!--    note:-->
<!--    <input type="text" name="note" value="">-->
<!--    <br>-->
<!---->
<!--    <br>-->
<!--    <input type="submit" value="Submit">-->
<!--</form>-->