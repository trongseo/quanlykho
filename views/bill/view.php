<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Bill */

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bill'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="wrap">

    <div class="container">
        <ul class="breadcrumb"><li><a href="/index.php">Home</a></li>
            <li><a href="/index.php?r=product%2Findex">Các sản phẩm</a></li>
            <li class="active">dam hai tac</li>
        </ul>        <div class="product-view">

            <h1>dam hai tac</h1>

            <p>
                <a class="btn btn-primary" href="/index.php?r=product%2Fupdate&amp;id=1">Cập nhật</a>        <a class="btn btn-danger" href="/index.php?r=product%2Fdelete&amp;id=1" data-confirm="Are you sure you want to delete this item?" data-method="post">Xóa</a>    </p>

            <?php

            foreach ($datas as $myitem) {
            ?>
            <table id="w0" class="table table-striped table-bordered detail-view"><tbody><tr><th>ID</th><td>1</td></tr>
                <tr><th>ID Phiếu nhập</th><td><?php echo ($myitem['idwarehouse']); ?></td></tr>
                <tr><th>ID Chứng từ</th><td>Cái</td></tr>
                <tr><th>ID Sản phẩm</th><td>1</td></tr>
                <tr><th>Sản phẩm</th><td>1</td></tr>
                <tr><th>Đơn vị</th><td>1</td></tr>
                <tr><th>Số lượng</th><td>1</td></tr>
                <tr><th>Giá bán</th><td>6.00</td></tr>
                <tr><th>Giá</th><td>4.00</td></tr>
                <tr><th>ID Nhà cung cấp</th><td>1</td></tr>
                <tr><th>Ngày nhập phiếu</th><td>1</td></tr>.
                <tr><th>Ghi chú</th><td>1</td></tr>
                </tbody></table>

                <?php
            }

            ?>
        </div>
    </div>
</div>

<script src="/assets/d70fefba/jquery.js"></script>
<script src="/assets/41dee904/yii.js"></script>
<script src="/assets/bc28ee4d/js/bootstrap.js"></script>
