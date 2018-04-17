<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Create Unit');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Unit'), 'url' => ['index']];
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
                    Đơn vị
                </h3>
                <div class="clearfix"></div>
            </div>
            <div class="kv-panel-before">
                <div class="btn-toolbar kv-grid-toolbar toolbar-container pull-right">
                    <div class="btn-group"><a class="btn btn-success" href="/index.php?r=unit%2Fcreate">Tạo đơn vị</a>
                    </div>
                </div>

                <div class="clearfix"></div>
            </div>
            <div id="w0-container" class="table-responsive kv-grid-container">
                <table class="kv-grid-table table table-striped kv-table-wrap" style="text-align:center">
                    <thead>
                    <tr>
                        <th data-col-seq="0" style="width:20%; text-align: center"><a href="/index.php?r=unit%2Findex&amp;sort=id" data-sort="id">ID Đơn vị</a></th>
                        <th data-col-seq="1" style="width:40%; text-align: center"><a href="/index.php?r=unit%2Findex&amp;sort=unit_name" data-sort="unit_name">Tên đơn vị</a></th>
                        <th data-col-seq="2" style="width:40%; text-align: center"><a href="/index.php?r=unit%2Findex&amp;sort=update_date" data-sort="update_date">Ngày cập nhật</a></th>
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
                            <td class="kv-align-center kv-align-middle" style="width:20%;" data-col-seq="0"><a href="index.php?r=unit/update&id=<?php echo ($myitem['id']); ?>"><?php echo ($myitem['id']); ?></a></td>
                            <td class="kv-align-center kv-align-middle" style="width:40%;" data-col-seq="1"><?php echo ($myitem['unit_name']); ?></td>
                            <td class="kv-align-center kv-align-middle" data-col-seq="2"><?php echo ($myitem['update_date']); ?></td>
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