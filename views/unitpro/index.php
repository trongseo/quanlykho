<?php
/**
 * Created by PhpStorm.
 * User: sba010
 * Date: 5/3/2018
 * Time: 4:44 PM
 */


$this->title = Yii::t('app', 'Unit Pro');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'unit pro'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


$js = <<<JS



JS;

$this->registerJs($js, $this::POS_END);

?>

<div class="wrap">
    <div class="container">
        <div class="avg-form">

            <form action="/index.php?r=avg%2Findex" method="post">
                <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>"/>


                <div class="row">
                    <div class="col-sm-6">

                    </div>
                    <div class="col-sm-6">

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
                            Xuất nhập tồn
                        </h3>
                        <div class="clearfix"></div>
                    </div>
                    <div id="w0-container" class="table-responsive kv-grid-container">
                        <table class="kv-grid-table table table-striped kv-table-wrap ">
                            <thead>
                            <tr>
                                <th data-col-seq="0">ID Sản Phẩm</th>
                                <th data-col-seq="1">Tên sản phẩm</th>
                                <th data-col-seq="2">Tổng số lượng nhập</th>
                                <th data-col-seq="3">Tổng số lượng xuất </th>
                                <th data-col-seq="4">Tồn trước kì</th>
                                <th data-col-seq="4">Tồn trong kì</th>
                                <th data-col-seq="4">Tồn cuối kì</th>
                            </tr>

                            </thead>
                            <tbody>
                            <?php
                            foreach ($dataunit as $myitem) {
                                ?>
                                <tr data-key="1">
                                    <td style="text-align: left"
                                        data-col-seq="0"> </td>
                                    <td style="text-align: left"
                                        data-col-seq="1"> </td>
                                    <td style="text-align: left"
                                        data-col-seq="2">
                                    </td>
                                    <td style="text-align: left" data-col-seq="3">
                                    </td>
                                    <td style="text-align: left" data-col-seq="5">
                                    </td>
                                    <td style="text-align: left" data-col-seq="4">
                                    </td>
                                    <td style="text-align: left" data-col-seq="5">
                                        <?php var_dump($myitem) ?>
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
    </div>
</div>

</div>

<script src="/assets/d70fefba/jquery.js"></script>
<script src="/assets/41dee904/yii.js"></script>
<script src="/assets/41dee904/yii.validation.js"></script>
<script src="/assets/41dee904/yii.activeForm.js"></script>
<script src="/assets/bc28ee4d/js/bootstrap.js"></script>

